@extends('layouts.app')

@section('content')
    <h2>Buat Tiket Baru</h2>

    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf

        <div>
            <label>Judul</label><br>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title') <div>{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Deskripsi</label><br>
            <textarea name="description" required>{{ old('description') }}</textarea>
            @error('description') <div>{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Prioritas</label><br>
            <select name="priority">
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
        </div>
        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('tickets.index') }}">Batal</a>
    </form>
@endsection