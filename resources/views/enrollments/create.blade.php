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
                        Pilih peserta dan kursus yang ingin diikuti.
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

                    <form action="{{ route('enrollments.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="participant_id" class="form-label">
                                Pilih Peserta
                            </label>

                            <select
                                name="participant_id"
                                id="participant_id"
                                class="form-select @error('participant_id') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Pilih peserta --</option>

                                @foreach ($participants as $participant)
                                    <option
                                        value="{{ $participant->id }}"
                                        @selected(old('participant_id') == $participant->id)
                                    >
                                        {{ $participant->name }} ({{ $participant->email }})
                                    </option>
                                @endforeach
                            </select>

                            @error('participant_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
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
                                        @selected(old('course_id') == $course->id)
                                    >
                                        {{ $course->name }} - Rp {{ number_format($course->fee, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>

                            @error('course_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Kirim Pendaftaran
                        </button>

                        <a href="{{ route('enrollments.index') }}"
                           class="btn btn-outline-secondary">
                            Kembali
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection