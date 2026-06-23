@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4">
                <h3 class="fw-bold mb-4"> Buat Pengumuman Baru</h3>
                
                {{-- PERBAIKAN: Memastikan action mengarah ke name route store admin yang benar --}}
                <form action="{{ route('announcements.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Contoh: Jadwal UTS Semester Genap" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori Info</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Akademik">Akademik</option>
                            <option value="Beasiswa">Beasiswa</option>
                            <option value="Kegiatan / Event">Kegiatan / Event</option>
                            <option value="Fasilitas Kampus">Fasilitas Kampus</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Pengumuman</label>
                        <textarea name="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" placeholder="Tuliskan detail informasi di sini..." required>{{ old('isi') }}</textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        {{-- PERBAIKAN: Memastikan tombol batal mengarah ke dashboard admin pengumuman --}}
                        <a href="{{ route('announcements.admin') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Terbitkan Pengumuman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection