@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')
<section class="hero-panel mb-4 overflow-hidden">
    <div class="row align-items-center g-0">
        <div class="col-lg-7 p-4 p-lg-5">
            <span class="eyebrow">PROJECT PEMROGRAMAN WEB III</span>

            <h1 class="display-5 fw-bold mt-2">
                Kelola kursus, peserta, dan pendaftaran dalam satu aplikasi.
            </h1>

            <p class="lead text-secondary mt-3">
                KursusKu mengintegrasikan Route, Controller, Blade, Vite,
                Bootstrap, jQuery Ajax, MySQL, Eloquent CRUD, relasi database,
                search, filter, dan pagination.
            </p>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a class="btn btn-primary btn-lg"
                   href="{{ route('courses.index') }}">
                    Lihat Course
                </a>

                <a class="btn btn-outline-primary btn-lg"
                   href="{{ route('enrollments.create') }}">
                    Buat Enrollment
                </a>
            </div>
        </div>

        <div class="col-lg-5">
            <img
                class="w-100 hero-image"
                src="{{ asset('images/hero-kursus.png') }}"
                alt="Ilustrasi kegiatan belajar KursusKu"
            >
        </div>
    </div>
</section>

{{-- STATISTIK --}}
<section class="mb-5">
    <div class="row g-3">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <span>Total Course</span>
                <strong>{{ $stats['courses'] }}</strong>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <span>Course Open</span>
                <strong>{{ $stats['open_courses'] }}</strong>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <span>Participant</span>
                <strong>{{ $stats['participants'] }}</strong>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <span>Enrollment</span>
                <strong>{{ $stats['enrollments'] }}</strong>
            </div>
        </div>
    </div>
</section>

{{-- DAFTAR COURSE --}}
<section>
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
        <div>
            <span class="eyebrow">DATA DARI ELOQUENT</span>
            <h2 class="h3 mb-0">Course yang sedang dibuka</h2>
        </div>

        <a href="{{ route('courses.index') }}"
           class="btn btn-sm btn-outline-secondary">
            Semua course
        </a>
    </div>

    <div class="row g-3">
        @forelse ($featured as $course)
            <div class="col-md-6 col-xl-4">
                <article class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        {{-- STATUS DAN KODE --}}
                        <div class="d-flex justify-content-between gap-2">
                            <span class="badge text-bg-success">
                                {{ strtoupper($course->status) }}
                            </span>

                            <span class="text-secondary small">
                                {{ $course->code }}
                            </span>
                        </div>

                        {{-- NAMA COURSE --}}
                        <h3 class="h5 mt-3">
                            {{ $course->name }}
                        </h3>

                        {{-- DESKRIPSI --}}
                        <p class="text-secondary">
                            {{ $course->description ?: 'Belum ada deskripsi kursus.' }}
                        </p>

                        {{-- BIAYA DAN TANGGAL MULAI --}}
                        <div class="small d-flex justify-content-between gap-2 border-top pt-3">
                            <span>
                                Rp {{ number_format($course->fee, 0, ',', '.') }}
                            </span>

                            <span>
                                {{ $course->start_date?->format('d/m/Y') ?? 'Belum ditentukan' }}
                            </span>
                        </div>

                        {{-- TOMBOL DETAIL --}}
                        <div class="mt-3">
                            <a href="{{ route('courses.show', $course) }}"
                               class="btn btn-sm btn-outline-primary">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary">
                    Belum ada course berstatus open.
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection