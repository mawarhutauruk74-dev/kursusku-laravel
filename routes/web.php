<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/courses/{course}/availability', [
    CourseController::class,
    'availability'
])->name('courses.availability');

Route::resource('courses', CourseController::class);

Route::resource('enrollments', EnrollmentController::class)
    ->only(['index', 'create', 'store']);

Route::delete('/participants/{participant}', [
    EnrollmentController::class,
    'destroyParticipant'
])->name('participants.destroy');

Route::get('/pendaftaran', function () {
    return redirect()->route('enrollments.create');
})->name('registration');