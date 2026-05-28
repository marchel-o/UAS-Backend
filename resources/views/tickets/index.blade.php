@extends('layouts.app')

@section('content')
    <h2>Daftar Tiket</h2>
    <a href="{{ route('tickets.create') }}"><button>Buat Tiket Baru</button></a>
    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelapor</th>
                <th>Judul</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->user->full_name ?? 'Anonim' }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->priority }}</td>
                <td>{{ $ticket->status }}</td>
                <td><a href="{{ route('tickets.show', $ticket->id) }}">Detail</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Belum ada tiket.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection