@extends('layouts.app')
@section('title', 'Edit Kursus')

@section('content')

<style>
    .edit-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 20px 15px;
    }

    .edit-title {
        font-size: 22px;
        font-weight: 600;
        color: #172b4d;
        margin-bottom: 18px;
    }

    .edit-alert {
        background: #f8d7da;
        color: #842029;
        border: 1px solid #f5aeb5;
        border-radius: 5px;
        padding: 14px 20px;
        margin-bottom: 12px;
        font-size: 13px;
    }

    .edit-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 6px;
    }

    .edit-group {
        margin-bottom: 16px;
    }

    .edit-group label {
        display: block;
        font-size: 13px;
        color: #263b5a;
        margin-bottom: 7px;
    }

    .edit-control {
        display: block;
        width: 100%;
        box-sizing: border-box;
        padding: 7px 10px;
        border: 1px solid #d5dce5;
        border-radius: 5px;
        font-size: 13px;
        color: #172b4d;
        background: #ffffff;
    }

    .edit-control:focus {
        outline: none;
        border-color: #80bdff;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, .12);
    }

    textarea.edit-control {
        min-height: 88px;
        resize: vertical;
    }

    .edit-error {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .edit-invalid {
        border-color: #dc3545;
    }

    .edit-actions {
        display: flex;
        gap: 8px;
        margin-top: 18px;
    }

    .btn-save {
        background: #0d6efd;
        color: white;
        border: 1px solid #0d6efd;
        padding: 9px 15px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-size: 13px;
    }

    .btn-back {
        background: white;
        color: #495057;
        border: 1px solid #adb5bd;
        padding: 9px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 13px;
    }
</style>

<div class="edit-container">

    <h2 class="edit-title">Edit Kursus</h2>

    @if ($errors->any())
        <div class="edit-alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="edit-card">

        <form action="{{ route('courses.update', $course->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="edit-group">
                <label for="code">Kode Kursus</label>
                <input
                    type="text"
                    name="code"
                    id="code"
                    class="edit-control @error('code') edit-invalid @enderror"
                    value="{{ old('code', $course->code) }}"
                    maxlength="20"
                    required
                >
                @error('code')
                    <div class="edit-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-group">
                <label for="name">Nama Kursus</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="edit-control @error('name') edit-invalid @enderror"
                    value="{{ old('name', $course->name) }}"
                    maxlength="120"
                    required
                >
                @error('name')
                    <div class="edit-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-group">
                <label for="description">Deskripsi</label>
                <textarea
                    name="description"
                    id="description"
                    class="edit-control @error('description') edit-invalid @enderror"
                >{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <div class="edit-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-group">
                <label for="fee">Biaya Kursus (Rp)</label>
                <input
                    type="number"
                    name="fee"
                    id="fee"
                    class="edit-control @error('fee') edit-invalid @enderror"
                    value="{{ old('fee', $course->fee) }}"
                    min="0"
                    required
                >
                @error('fee')
                    <div class="edit-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-group">
                <label for="quota">Kuota Peserta</label>
                <input
                    type="number"
                    name="quota"
                    id="quota"
                    class="edit-control @error('quota') edit-invalid @enderror"
                    value="{{ old('quota', $course->quota) }}"
                    min="1"
                    max="500"
                    required
                >
                @error('quota')
                    <div class="edit-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-group">
                <label for="start_date">Tanggal Mulai</label>
                <input
                    type="date"
                    name="start_date"
                    id="start_date"
                    class="edit-control @error('start_date') edit-invalid @enderror"
                    value="{{ old('start_date', \Carbon\Carbon::parse($course->start_date)->format('Y-m-d')) }}"
                    required
                >
                @error('start_date')
                    <div class="edit-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-group">
                <label for="status">Status Kursus</label>
                <select
                    name="status"
                    id="status"
                    class="edit-control @error('status') edit-invalid @enderror"
                    required
                >
                    <option value="draft"
                        {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>

                    <option value="open"
                        {{ old('status', $course->status) == 'open' ? 'selected' : '' }}>
                        Open
                    </option>

                    <option value="closed"
                        {{ old('status', $course->status) == 'closed' ? 'selected' : '' }}>
                        Closed
                    </option>
                </select>
                @error('status')
                    <div class="edit-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-actions">
                <button type="submit" class="btn-save">
                    Simpan Perubahan
                </button>

                <a href="{{ route('courses.index') }}" class="btn-back">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection