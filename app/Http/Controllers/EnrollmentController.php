<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    // Menampilkan laporan pendaftaran
    public function index(): View
    {
        $enrollments = Enrollment::with(['participant', 'course'])
            ->latest()
            ->paginate(10);

        return view('enrollments.index', compact('enrollments'));
    }

    // Menampilkan form pendaftaran
    public function create(): View
    {
        $participants = Participant::orderBy('name')->get();

        $courses = Course::where('status', 'open')
            ->orderBy('name')
            ->get();

        return view('enrollments.create', compact(
            'participants',
            'courses'
        ));
    }

    // Menyimpan pendaftaran
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'participant_id' => [
                'required',
                'exists:participants,id',
            ],
            'course_id' => [
                'required',
                Rule::exists('courses', 'id')
                    ->where('status', 'open'),
                Rule::unique('enrollments', 'course_id')
                    ->where(function ($query) use ($request) {
                        $query->where(
                            'participant_id',
                            $request->input('participant_id')
                        );
                    }),
            ],
        ], [
            'participant_id.required' => 'Peserta wajib dipilih.',
            'participant_id.exists' => 'Peserta tidak ditemukan.',
            'course_id.required' => 'Kursus wajib dipilih.',
            'course_id.exists' => 'Kursus tidak tersedia atau belum dibuka.',
            'course_id.unique' => 'Participant ini sudah terdaftar pada course tersebut.',
        ]);

        Enrollment::create([
            'participant_id' => $validated['participant_id'],
            'course_id' => $validated['course_id'],
            'enrollment_date' => now()->toDateString(),
            'status' => 'registered',
        ]);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Pendaftaran berhasil disimpan!');
    }

    // Menghapus peserta beserta seluruh pendaftarannya
    public function destroyParticipant(
        Participant $participant
    ): RedirectResponse {
        $namaPeserta = $participant->name;

        $participant->delete();

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                "Peserta {$namaPeserta} dan seluruh pendaftarannya berhasil dihapus."
            );
    }
}