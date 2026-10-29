@extends('layouts.app')

@section('title', 'Daftar Kursus - KursusKu')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1">Daftar Kursus</h1>
        <p class="text-secondary mb-0">
            Kelola, cari, filter, dan hapus kursus KursusKu.
        </p>
    </div>

    <a href="{{ route('courses.create') }}" class="btn btn-primary">
        + Tambah Kursus
    </a>
</div>

{{-- PESAN SUKSES --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

{{-- PESAN ERROR --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM PENCARIAN DAN FILTER --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <h2 class="h5 mb-3">Cari dan Filter Kursus</h2>

        <form action="{{ route('courses.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="search" class="form-label">Kata Kunci</label>
                    <input
                        type="text"
                        name="search"
                        id="search"
                        class="form-control"
                        placeholder="Masukkan kode, nama, atau deskripsi kursus"
                        value="{{ $search ?? '' }}"
                    >
                </div>

                <div class="col-md-4">
                    <label for="status" class="form-label">Status Kursus</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="open" {{ ($status ?? '') === 'open' ? 'selected' : '' }}>
                            Open
                        </option>
                        <option value="closed" {{ ($status ?? '') === 'closed' ? 'selected' : '' }}>
                            Closed
                        </option>
                    </select>
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>
                </div>

                <div class="col-12">
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
                        Reset Pencarian
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- JUMLAH HASIL --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h2 class="h5 mb-0">Hasil Kursus</h2>
    <span class="badge text-bg-primary fs-6">
        Total hasil: {{ $courses->total() }} kursus
    </span>
</div>

{{-- KARTU KURSUS --}}
<div class="row g-3">
    @forelse ($courses as $course)
        <div class="col-md-6 col-xl-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <span class="badge {{ $course->status === 'open' ? 'text-bg-success' : 'text-bg-secondary' }}">
                            {{ strtoupper($course->status) }}
                        </span>

                        <span class="small text-secondary">
                            {{ $course->code }}
                        </span>
                    </div>

                    <h3 class="h5 mt-3">{{ $course->name }}</h3>

                    <p class="text-secondary">
                        {{ $course->description ?: 'Belum ada deskripsi kursus.' }}
                    </p>

                    <div class="border-top pt-3 mt-auto">
                        <p class="mb-2">
                            <strong>Biaya:</strong>
                            Rp {{ number_format($course->fee, 0, ',', '.') }}
                        </p>

                        <p class="mb-3">
                            <strong>Tanggal mulai:</strong>
                            {{ $course->start_date?->format('d/m/Y') ?? 'Belum ditentukan' }}
                        </p>

                        {{-- TOMBOL AKSI --}}
                        <div class="d-flex flex-wrap gap-2">
                            <a
                                href="{{ route('courses.show', $course) }}"
                                class="btn btn-sm btn-outline-primary">
                                Detail
                            </a>

                            <a
                                href="{{ route('courses.edit', $course) }}"
                                class="btn btn-sm btn-outline-warning">
                                Edit
                            </a>

                            <form
                                action="{{ route('courses.destroy', $course) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kursus {{ $course->name }}?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                <h3 class="h6">Kursus tidak ditemukan</h3>
                <p class="mb-2">
                    Tidak ada kursus yang sesuai dengan kata kunci atau filter yang dipilih.
                </p>
                <a href="{{ route('courses.index') }}" class="alert-link">
                    Tampilkan semua kursus
                </a>
            </div>
        </div>
    @endforelse
</div>

{{-- PAGINATION --}}
@if ($courses->hasPages())
    <div class="mt-4">
        {{ $courses->links() }}
    </div>
@endif
@endsection