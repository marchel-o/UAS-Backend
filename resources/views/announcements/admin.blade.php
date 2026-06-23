@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Panel Kelola Info Kampus (Admin)</h2>
        <div>
            <a href="{{ route('announcements.index') }}" class="btn btn-outline-secondary btn-sm me-2">Lihat Sisi User</a>
            <a href="{{ route('announcements.create') }}" class="btn btn-success btn-sm">➕ Tambah Pengumuman</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="50%">Judul Pengumuman</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Tanggal Dibuat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcements as $index => $info)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{-- PERBAIKAN: Mengamankan Judul --}}
                                <strong class="text-dark">{{ $info->title ?? $info->judul }}</strong>
                            </td>
                            <td>
                                {{-- PERBAIKAN: Mengamankan Kategori --}}
                                <span class="badge bg-secondary">{{ $info->category ?? $info->kategori }}</span>
                            </td>
                            <td>{{ $info->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('announcements.edit', $info->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                
                                <form action="{{ route('announcements.destroy', $info->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm text-white" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection