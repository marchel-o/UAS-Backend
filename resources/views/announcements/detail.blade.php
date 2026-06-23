@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('announcements.index') }}" class="btn btn-light btn-sm mb-3">← Kembali ke Daftar</a>
            
            <div class="card shadow-sm border-0 p-4">
                <span class="badge bg-primary align-self-start mb-2">{{ $announcement->kategori }}</span>
                <h1 class="fw-bold mb-2">{{ $announcement->judul }}</h1>
                <small class="text-muted mb-4 d-block">Tanggal Terbit: {{ $announcement->created_at->format('d F Y, H:i') }}</small>
                <hr>
                <div class="fs-5 text-secondary" style="line-height: 1.8; white-space: pre-line;">
                    {{ $announcement->isi }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection