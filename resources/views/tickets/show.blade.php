@extends('layouts.app')

@section('content')
    <h2>#{{ $ticket->id }} - {{ $ticket->title }}</h2>
    
    <p><strong>Pelapor:</strong> {{ $ticket->user->full_name ?? 'Anonim' }}</p>
    <p><strong>Kategori:</strong> {{ $ticket->category->name ?? 'Tidak ada kategori' }}</p>
    <p><strong>Status:</strong> {{ strtoupper($ticket->status) }}</p>
    <p><strong>Prioritas:</strong> {{ strtoupper($ticket->priority) }}</p>
    
    <div>
        <strong>Deskripsi Detail:</strong><br>
        {{ $ticket->description }}
    </div>
    
    <hr>

    <h3>Diskusi & Komentar</h3>
    <ul>
        @forelse($ticket->comments as $comment)
            <li style="margin-bottom: 10px;">
                <strong>{{ $comment->user->full_name ?? 'Seseorang' }}</strong> berkata:<br>
                {{ $comment->content }}
            </li>
        @empty
            <li>Belum ada komentar untuk tiket ini.</li>
        @endforelse
    </ul>

    <hr>

    <h4>Tambahkan Komentar</h4>
    <form method="POST" action="{{ route('comments.store', $ticket->id) }}">
        @csrf
        <textarea name="content" required style="width: 100%; height: 70px;"></textarea><br>
        @error('content') <div style="color:red;">{{ $message }}</div> @enderror
        <br>
        <button type="submit">Kirim Balasan</button>
    </form>

    <br><br>
    <a href="{{ route('tickets.index') }}">Kembali ke Daftar Tiket</a>
@endsection