@extends('layouts.app')

@section('content')
    <h2>Buat Tiket Baru</h2>

    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf

        <div>
            <label>Judul Laporan</label><br>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Kategori Masalah</label><br>
            <select name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Deskripsi Detail</label><br>
            <textarea name="description" required style="height: 100px; width: 300px;">{{ old('description') }}</textarea>
            @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Prioritas Penanganan</label><br>
            <select name="priority" required>
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
            @error('priority') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <button type="submit">Simpan Tiket</button>
        <a href="{{ route('tickets.index') }}" style="margin-left: 10px;">Batal</a>
    </form>
@endsection