@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2> Edit Pengumuman</h2>
    <hr>

    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Pengumuman</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $announcement->judul) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="Akademik" {{ $announcement->kategori == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Non-Akademik" {{ $announcement->kategori == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                    <option value="Lainnya" {{ $announcement->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Pengumuman</label>
                <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $announcement->isi) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('announcements.admin') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection