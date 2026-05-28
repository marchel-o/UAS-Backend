@extends('layouts.app')

@section('content')
    <h2>Tambah Kategori Baru</h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div>
            <label>Nama Kategori</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Deskripsi Kategori</label><br>
            <textarea name="description" required style="height: 80px; width: 300px;">{{ old('description') }}</textarea>
            @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <button type="submit">Simpan Kategori</button>
        <a href="{{ route('categories.index') }}" style="margin-left: 10px;">Batal</a>
    </form>
@endsection