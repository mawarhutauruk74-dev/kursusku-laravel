```blade
@extends('layouts.app')

@section('title', 'Detail Kursus - KursusKu')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <h1 class="h3 mb-0">Detail Kursus</h1>

    <a href="{{ route('courses.index') }}"
       class="btn btn-outline-secondary">
        Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        {{-- Status Kursus --}}
        <span class="badge {{ $course->status === 'open' ? 'text-bg-success' : 'text-bg-secondary' }}">
            {{ strtoupper($course->status) }}
        </span>

        {{-- Informasi Utama --}}
        <h2 class="mt-3">{{ $course->name }}</h2>

        <p class="text-secondary">
            Kode: {{ $course->code }}
        </p>

        <hr>

        {{-- Deskripsi --}}
        <h3 class="h6">Deskripsi</h3>

        <p>
            {{ $course->description ?: 'Belum ada deskripsi kursus.' }}
        </p>

        {{-- Biaya --}}
        <h3 class="h6 mt-4">Biaya Kursus</h3>

        <p class="fs-5 fw-bold text-primary">
            Rp {{ number_format($course->fee, 0, ',', '.') }}
        </p>

        {{-- Tanggal Mulai --}}
        <h3 class="h6 mt-4">Tanggal Mulai</h3>

        <p>
            {{ $course->start_date?->format('d/m/Y') ?? 'Belum ditentukan' }}
        </p>

        <hr>

        {{-- Cek Ketersediaan --}}
        <div class="mt-4">
            <h3 class="h5">Ketersediaan Kursus</h3>

            <p class="text-secondary">
                Klik tombol berikut untuk memeriksa status kursus terbaru.
            </p>

            <button
                type="button"
                id="checkAvailability"
                class="btn btn-outline-primary"
                data-url="{{ route('courses.availability', $course->id) }}">
                Cek Ketersediaan
            </button>

            {{-- Tempat menampilkan hasil pemeriksaan --}}
            <div
                id="availabilityResult"
                class="alert mt-3 d-none"
                role="status"
                aria-live="polite">
            </div>
        </div>

        <hr class="my-4">

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-end gap-2 flex-wrap">

            <a href="{{ route('courses.edit', $course->id) }}"
               class="btn btn-primary">
                Edit Kursus
            </a>

        </div>

    </div>
</div>
@endsection