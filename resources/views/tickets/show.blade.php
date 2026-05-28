@extends('layouts.app')

@section('content')
    <h2>#{{ $ticket->id }} - {{ $ticket->title }}</h2>
    <p><strong>Pelapor:</strong> {{ $ticket->user->full_name ?? 'Anonim' }}</p>
    <p><strong>Status:</strong> {{ $ticket->status }}</p>
    <p><strong>Prioritas:</strong> {{ $ticket->priority }}</p>
    
    <div>
        <strong>Deskripsi:</strong><br>
        {{ $ticket->description }}
    </div>
    
    <hr>

    <h3>Komentar / Diskusi</h3>
    <ul>
        @forelse($ticket->comments as $comment)
            <li>
                <strong>{{ $comment->user->full_name ?? 'Seseorang' }}</strong>:<br>
                {{ $comment->content }}
            </li>
        @empty
            <li>Belum ada komentar.</li>
        @endforelse
    </ul>

    <hr>

    <h4>Tambah Komentar</h4>
    <form method="POST" action="{{ route('comments.store', $ticket->id) }}">
        @csrf
        <textarea name="content" required></textarea><br>
        @error('content') <div>{{ $message }}</div> @enderror
        <button type="submit">Kirim</button>
    </form>

    <br><br>
    <a href="{{ route('tickets.index') }}">Kembali ke Daftar Tiket</a>
@endsection