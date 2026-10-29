<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
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
            ->when(in_array($status, ['open', 'closed'], true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('start_date')
            ->paginate(10)
            ->withQueryString();

        return view('courses.index', compact('courses', 'search', 'status'));
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:courses,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fee' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'status' => 'required|in:open,closed',
        ]);

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course berhasil ditambahkan.');
    }

    public function show(Course $course): View
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:courses,code,' . $course->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fee' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'status' => 'required|in:open,closed',
        ]);

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course berhasil dihapus.');
    }

    public function availability(Course $course)
{
    $remainingSeats = match ($course->code) {
        'WEB001' => 12,
        'PHP001' => 8,
        'LAR001' => 4,
        default => 0,
    };

    return response()->json([
        'id' => $course->id,
        'code' => $course->code,
        'course' => $course->name,
        'status' => $course->status,
        'remaining' => $remainingSeats,
    ]);
}
}