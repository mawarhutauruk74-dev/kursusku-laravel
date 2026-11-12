@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Data Pendaftaran</h2>
            <p class="text-muted mb-0">
                Kelola data peserta dan pendaftaran kursus.
            </p>
        </div>

        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
            + Tambah Pendaftaran
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Nama Kursus</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($enrollments as $enrollment)
                            <tr>
                                <td>
                                    {{ $enrollments->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $enrollment->participant->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $enrollment->participant->email ?? '-' }}
                                </td>

                                <td>
                                    {{ $enrollment->participant->phone ?? '-' }}
                                </td>

                                <td>
                                    {{ $enrollment->course->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $enrollment->enrollment_date
                                        ? \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>

                                <td>
                                    @if($enrollment->participant)
                                        <form
                                            action="{{ route('participants.destroy', $enrollment->participant->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus peserta ini beserta seluruh pendaftarannya?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Hapus Peserta
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada data pendaftaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $enrollments->links() }}
            </div>

        </div>
    </div>

</div>
@endsection