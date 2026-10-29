@extends('layouts.app')

@section('title', 'Data Peserta - KursusKu')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1">Data Peserta</h1>
        <p class="text-secondary mb-0">
            Daftar peserta yang telah mendaftar kursus di KursusKu.
        </p>
    </div>

    <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
        + Tambah Pendaftaran
    </a>
</div>

{{-- PESAN SUKSES --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>
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

{{-- RINGKASAN --}}
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary mb-1">Total Pendaftaran</p>
                <h2 class="h3 mb-0">{{ $enrollments->total() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-secondary mb-1">Pendaftaran di Halaman Ini</p>
                <h2 class="h3 mb-0">{{ $enrollments->count() }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- TABEL DATA PESERTA --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h2 class="h5 mb-0">Daftar Pendaftaran</h2>

            <span class="badge text-bg-primary">
                {{ $enrollments->total() }} pendaftaran
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Kursus</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($enrollments as $enrollment)
                        <tr>
                            <td>
                                {{ $enrollments->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $enrollment->participant?->name ?? 'Data peserta tidak tersedia' }}
                            </td>

                            <td>
                                {{ $enrollment->participant?->email ?? '-' }}
                            </td>

                            <td>
                                {{ $enrollment->participant?->phone ?? '-' }}
                            </td>

                            <td>
                                {{ $enrollment->course?->name ?? 'Data kursus tidak tersedia' }}

                                @if ($enrollment->course?->code)
                                    <div class="small text-secondary">
                                        {{ $enrollment->course->code }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                {{ $enrollment->enrollment_date?->format('d/m/Y') ?? '-' }}
                            </td>

                            <td>
                                @if ($enrollment->status === 'registered')
                                    <span class="badge text-bg-success">
                                        Terdaftar
                                    </span>
                                @elseif ($enrollment->status === 'cancelled')
                                    <span class="badge text-bg-danger">
                                        Dibatalkan
                                    </span>
                                @else
                                    <span class="badge text-bg-secondary">
                                        {{ ucfirst($enrollment->status ?? 'Tidak diketahui') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="mb-2">
                                    Belum ada peserta yang mendaftar.
                                </p>

                                <a href="{{ route('enrollments.create') }}"
                                   class="btn btn-primary btn-sm">
                                    Tambah Pendaftaran
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($enrollments->hasPages())
            <div class="mt-3">
                {{ $enrollments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection