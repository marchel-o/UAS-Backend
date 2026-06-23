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
                <label class="form-label fw-bold">Judul Pengumuman</label>
                {{-- PERBAIKAN: Mengamankan value judul lama agar tetap tampil --}}
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $announcement->title ?? $announcement->judul) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Kategori</label>
                <select name="kategori" class="form-select" required>
                    {{-- PERBAIKAN: Mengamankan penanda 'selected' berdasarkan database --}}
                    @php $currentCategory = $announcement->category ?? $announcement->kategori; @endphp
                    <option value="Akademik" {{ old('kategori', $currentCategory) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Beasiswa" {{ old('kategori', $currentCategory) == 'Beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                    <option value="Kegiatan / Event" {{ old('kategori', $currentCategory) == 'Kegiatan / Event' ? 'selected' : '' }}>Kegiatan / Event</option>
                    <option value="Fasilitas Kampus" {{ old('kategori', $currentCategory) == 'Fasilitas Kampus' ? 'selected' : '' }}>Fasilitas Kampus</option>
                    <option value="Non-Akademik" {{ old('kategori', $currentCategory) == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                    <option value="Lainnya" {{ old('kategori', $currentCategory) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Isi Pengumuman</label>
                {{-- PERBAIKAN: Mengamankan value isi/deskripsi lama agar tetap tampil --}}
                <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $announcement->description ?? ($announcement->content ?? ($announcement->isi ?? $announcement->konten))) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('announcements.admin') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection