<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    // Menampilkan daftar kursus
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $courses = Course::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when(
                in_array($status, ['draft', 'open', 'closed'], true),
                function ($query) use ($status) {
                    $query->where('status', $status);
                }
            )
            ->orderBy('start_date')
            ->paginate(10)
            ->withQueryString();

        return view('courses.index', compact(
            'courses',
            'search',
            'status'
        ));
    }

    // Menampilkan form tambah kursus
    public function create(): View
    {
        return view('courses.create');
    }

    // Menyimpan kursus baru
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Kursus berhasil ditambahkan.');
    }

    // Menampilkan detail kursus
    public function show(Course $course): View
    {
        return view('courses.show', compact('course'));
    }

    // Menampilkan form edit kursus
    public function edit(Course $course): View
    {
        return view('courses.edit', compact('course'));
    }

    // Memperbarui data kursus
    public function update(
        UpdateCourseRequest $request,
        Course $course
    ) {
        $validated = $request->validated();

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Kursus berhasil diperbarui.');
    }

    // Menghapus kursus
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }

    // Mengecek ketersediaan kursus
    public function availability(Course $course): JsonResponse
    {
        $jumlahPendaftar = $course->enrollments()->count();

        $sisaKursi = max(0, $course->quota - $jumlahPendaftar);

        return response()->json([
            'id' => $course->id,
            'code' => $course->code,
            'course' => $course->name,
            'quota' => $course->quota,
            'jumlah_pendaftar' => $jumlahPendaftar,
            'remaining' => $sisaKursi,
            'sisa_kursi' => $sisaKursi,
            'available_seats' => $sisaKursi,
            'status' => $course->status,
        ]);
    }
}