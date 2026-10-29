<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    public function index(): View
    {
        $enrollments = Enrollment::with(['course', 'participant'])
            ->latest()
            ->paginate(10);

        $courses = Course::orderBy('name')->get();

        return view('enrollments.index', compact('enrollments', 'courses'));
    }

    public function create(): View
    {
        $courses = Course::where('status', 'open')
            ->orderBy('name')
            ->get();

        return view('enrollments.create', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $participant = Participant::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'] ?? null,
            ]
        );

        $alreadyEnrolled = Enrollment::where(
            'course_id',
            $validated['course_id']
        )
            ->where('participant_id', $participant->id)
            ->exists();

        if ($alreadyEnrolled) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Peserta sudah terdaftar pada kursus ini.',
                ]);
        }

        Enrollment::create([
            'course_id' => $validated['course_id'],
            'participant_id' => $participant->id,
            'enrollment_date' => now()->toDateString(),
            'status' => 'registered',
        ]);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Pendaftaran berhasil disimpan!');
    }
}