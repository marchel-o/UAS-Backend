@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Notifikasi Sukses / Gagal --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Tiket --}}
    <h2>#{{ $ticket->id }} - {{ $ticket->title }}</h2>
    <p><strong>Pelapor:</strong> {{ $ticket->user->name }}</p>
    <p><strong>Kategori:</strong> {{ $ticket->category->name }}</p>
    <p><strong>Status:</strong> <span class="badge bg-info text-dark">{{ strtoupper($ticket->status) }}</span></p>

    <hr>

    {{-- Bagian Ubah Status (Admin Only) --}}
    @if(auth()->user()->role === 'admin')
        <div class="card bg-light p-3 mb-4 border-0 shadow-sm">
            <h5> Ubah Status Ticket (Admin Only)</h5>
            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="status" class="form-control mb-2">
                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>OPEN</option>
                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>IN_PROGRESS</option>
                    <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>RESOLVED</option>
                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>CLOSED</option>
                </select>
                <textarea name="notes" class="form-control mb-2" placeholder="Catatan perubahan status"></textarea>
                <button type="submit" class="btn btn-secondary btn-sm">Update Status</button>
            </form>
        </div>
        <hr>
    @endif

    {{-- Detail Tiket --}}
    <p><strong>Prioritas:</strong> {{ strtoupper($ticket->priority) }}</p>
    <p><strong>Deskripsi Detail:</strong><br>{{ $ticket->description }}</p>

    <hr>

    {{-- Diskusi & Komentar --}}
    <h5> Diskusi & Komentar</h5>
    <ul class="list-group mb-3">
        @forelse($ticket->comments as $comment)
            <li class="list-group-item"><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</li>
        @empty
            <li class="list-group-item text-muted">Belum ada komentar untuk tiket ini.</li>
        @endforelse
    </ul>

    <h5>Tambahkan Komentar</h5>
    <form action="{{ route('comments.store', $ticket->id) }}" method="POST" class="mb-4">
        @csrf
        <textarea name="content" class="form-control" required placeholder="Tulis komentar..."></textarea>
        <button type="submit" class="btn btn-primary btn-sm mt-2">Kirim Komentar</button>
    </form>

    <hr>

    {{-- Bagian Rating Pelayanan --}}
    <h5> Penilaian Pelayanan</h5>
    @if($ticket->rating)
        <div class="alert alert-success border-0 shadow-sm">
            <strong>Skor Anda:</strong> 
            @for($i = 1; $i <= $ticket->rating->score; $i++)
                
            @endfor
            ({{ $ticket->rating->score }} Bintang)
            <br>
            <strong>Ulasan:</strong> "{{ $ticket->rating->comment ?? 'Tidak ada ulasan tertulis' }}"
        </div>
    {{-- PERBAIKAN: Form rating sekarang terbuka jika status 'resolved' ATAU 'closed' --}}
    @elseif((strtolower($ticket->status) === 'resolved' || strtolower($ticket->status) === 'closed') && auth()->id() === $ticket->user_id)
        <div class="card p-3 bg-light border-0 shadow-sm">
            <p class="text-success fw-bold mb-2">Tiket Selesai! Silakan berikan penilaian Anda terhadap pelayanan kami:</p>
            <form action="{{ route('tickets.rate', $ticket->id) }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label class="small fw-bold">Skor Pelayanan:</label>
                    <select name="score" class="form-control">
                        @for($i=5; $i>=1; $i--) <option value="{{ $i }}">{{ $i }} Bintang</option> @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label class="small fw-bold">Ulasan / Masukan:</label>
                    <textarea name="comment" class="form-control" placeholder="Tulis ulasan pelayanan admin & staff di sini..."></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Kirim Penilaian</button>
            </form>
        </div>
    @else
        <div class="alert alert-warning border-0 small">
             Penilaian hanya dapat diberikan oleh pemilik tiket setelah status pengaduan di-ubah menjadi <b>RESOLVED</b> atau <b>CLOSED</b> oleh admin.
        </div>
    @endif
</div>
@endsection