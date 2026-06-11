@extends('layouts.app')

@section('content')
    <h2>Daftar Tiket Pelaporan</h2>
    <a href="{{ route('tickets.create') }}"><button>+ Buat Tiket Baru</button></a>
    <br><br>

    <form method="GET" action="{{ route('tickets.index') }}">
        <select name="category_id">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>
    <br>

    <table border="1" cellpadding="8" style="border-collapse: collapse; width: 100%;">
        <thead style="background-color: #f4f4f4;">
            <tr>
                <th>ID Ticket</th>
                <th>Kategori</th>
                <th>Judul Masalah</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td>#{{ $ticket->id }}</td>
                <td>{{ $ticket->category->name ?? '-' }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ strtoupper($ticket->priority) }}</td>
                <td>{{ strtoupper($ticket->status) }}</td>
                <td>
                    <a href="{{ route('tickets.show', $ticket->id) }}">Lihat Detail</a>

                    {{-- FITUR HAPUS (Khusus Admin) --}}
                    @if(auth()->user()->role === 'admin')
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red;" onclick="return confirm('Yakin ingin menghapus tiket ini?')">
                                Hapus
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" align="center">Belum ada tiket pelaporan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection