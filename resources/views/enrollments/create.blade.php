@extends('layouts.app')

@section('title', 'Pendaftaran Kursus - KursusKu')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <h1 class="h3 fw-bold mb-2">
                        Pendaftaran Kursus
                    </h1>

                    <p class="text-secondary mb-4">
                        Isi data berikut untuk mendaftar kursus di KursusKu.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Pendaftaran belum dapat diproses.</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        action="{{ route('enrollments.store') }}"
                        method="POST"
                    >
                        @csrf

                        <div class="mb-3">
                            <label for="course_id" class="form-label">
                                Pilih Kursus
                            </label>

                            <select
                                name="course_id"
                                id="course_id"
                                class="form-select @error('course_id') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Pilih kursus --</option>

                                @foreach ($courses as $course)
                                    <option
                                        value="{{ $course->id }}"
                                        @selected((string) old('course_id') === (string) $course->id)
                                    >
                                        {{ $course->name }} — Rp {{ number_format($course->fee, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>

                            @error('course_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Informasi sisa kursi dari AJAX --}}
                        <div
                            id="availability"
                            class="alert alert-info mb-4"
                            role="status"
                            aria-live="polite"
                        >
                            Pilih kursus untuk melihat sisa kursi.
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                required
                            >

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label">
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                            >
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Kirim Pendaftaran
                        </button>

                        <a
                            href="{{ route('home') }}"
                            class="btn btn-outline-secondary"
                        >
                            Kembali ke Beranda
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection