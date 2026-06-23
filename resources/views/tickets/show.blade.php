@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Header Tiket --}}
    <h2>#{{ $ticket->id }} - {{ $ticket->title }}</h2>
    <p><strong>Pelapor:</strong> {{ $ticket->user->full_name }}</p>
    <p><strong>Kategori:</strong> {{ $ticket->category->name }}</p>
    <p><strong>Status:</strong> {{ strtoupper($ticket->status) }}</p>

    <hr>

    {{-- Bagian Ubah Status (Admin Only) --}}
    @if(auth()->user()->role === 'admin')
    <h5>Ubah Status Ticket</h5>
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="status" class="form-control">
            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>OPEN</option>
            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>IN_PROGRESS</option>
            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>RESOLVED</option>
            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>CLOSED</option>
        </select>
        <textarea name="notes" class="form-control mt-2" placeholder="Catatan perubahan status"></textarea>
        <button type="submit" class="btn btn-secondary mt-2">Update Status</button>
    </form>
    <hr>
    @endif

    {{-- Detail Tiket --}}
    <p><strong>Prioritas:</strong> {{ strtoupper($ticket->priority) }}</p>
    <p><strong>Deskripsi Detail:</strong><br>{{ $ticket->description }}</p>
    @if($ticket->attachment)
    <div style="margin-top: 1.5rem; margin-bottom: 1.5rem;">
        <strong>Foto Lampiran Bukti:</strong><br>
        {{-- Mengambil URL public dari symlink storage --}}
        <img src="{{ asset('storage/' . $ticket->attachment) }}"
            alt="Lampiran Bukti {{ $ticket->title }}"
            style="max-width: 100%; max-height: 400px; border: 1px solid #ccc; border-radius: 5px; margin-top: 0.5rem; object-fit: contain;">
    </div>
    @endif

    <hr>

    {{-- Diskusi & Komentar --}}
    <h5>Diskusi & Komentar</h5>
    <ul>
        @forelse($ticket->comments as $comment)
        <li><strong>{{ $comment->user->full_name }}:</strong> {{ $comment->content }}</li>
        @empty
        <li>Belum ada komentar untuk tiket ini.</li>
        @endforelse
    </ul>

    <h5>Tambahkan Komentar</h5>
    <form action="{{ route('comments.store', $ticket->id) }}" method="POST" class="mb-4">
        @csrf
        <textarea name="content" class="form-control" required placeholder="Tulis komentar..."></textarea>
        <button type="submit" class="btn btn-primary mt-2">Kirim Komentar</button>
    </form>

    <hr>

    {{-- Bagian Rating --}}
    <h5>Penilaian</h5>
    @if($ticket->rating)
    <p>Skor: {{ $ticket->rating->score }} Bintang | Ulasan: {{ $ticket->rating->comment }}</p>
    @elseif(strtolower($ticket->status) === 'closed' && auth()->id() === $ticket->user_id)
    <form action="{{ route('tickets.rate', $ticket->id) }}" method="POST">
        @csrf
        <select name="score" class="form-control mb-2">
            @for($i=5; $i>=1; $i--) <option value="{{ $i }}">{{ $i }} Bintang</option> @endfor
        </select>
        <textarea name="comment" class="form-control mb-2" placeholder="Tulis ulasan Anda..."></textarea>
        <button type="submit" class="btn btn-success">Kirim Penilaian</button>
    </form>
    @else
    <p>Belum ada rating untuk tiket ini.</p>
    @endif
</div>
@endsection