@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Pengumuman & Info Kampus</h2>
        <a href="{{ route('tickets.index') }}" class="btn btn-outline-primary btn-sm">🎫 Halaman Tiket Saya</a>
    </div>

    <div class="row">
        @forelse($announcements as $info)
            <div class="col-md-12 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="card-title fw-bold text-dark mb-0">{{ $info->judul }}</h4>
                            <span class="badge bg-info text-dark fw-semibold">{{ $info->kategori }}</span>
                        </div>
                        
                        <p class="text-muted small mb-3">
                            Diterbitkan pada: {{ $info->created_at->format('d M Y') }} oleh Admin
                        </p>
                        
                        <hr>
                        
                        <p class="card-text text-secondary" style="white-space: pre-line;">
                            {{ $info->konten }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 text-center py-5">
                <div class="card shadow-sm border-0 py-5">
                    <p class="text-muted mb-0">Belum ada pengumuman atau info kampus saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection