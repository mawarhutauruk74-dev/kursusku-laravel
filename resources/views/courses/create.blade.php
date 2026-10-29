@extends('layouts.app')

@section('title', 'Tambah Kursus - KursusKu')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h1 class="h3 mb-4">Tambah Kursus</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="code" class="form-label">Kode Kursus</label>
                        <input type="text" name="code" id="code"
                               class="form-control"
                               value="{{ old('code') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kursus</label>
                        <input type="text" name="name" id="name"
                               class="form-control"
                               value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description"
                                  class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="fee" class="form-label">Biaya Kursus (Rp)</label>
                        <input type="number" name="fee" id="fee"
                               class="form-control" min="0"
                               value="{{ old('fee', 0) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date"
                               class="form-control"
                               value="{{ old('start_date') }}">
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Status Kursus</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="open" @selected(old('status', 'open') === 'open')>
                                Open
                            </option>
                            <option value="closed" @selected(old('status') === 'closed')>
                                Closed
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan Kursus
                    </button>

                    <a href="{{ route('courses.index') }}"
                       class="btn btn-outline-secondary">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection