<h1>{{ $ticket->title }}</h1>
<p><strong>Status:</strong> {{ $ticket->status }}</p>
<p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>

<hr>
<h3>Komentar Diskusi</h3>
<ul>
    @forelse($ticket->comments as $comment)
        <li>{{ $comment->content }} </li>
    @empty
        <li>Belum ada komentar pada tiket ini.</li>
    @endforelse
</ul>

<form action="{{ route('comments.store', $ticket->id) }}" method="POST">
    @csrf
    <input type="text" name="content" placeholder="Tulis komentar..." required>
    <button type="submit">Kirim Komentar</button>
</form>
<br><br>
<a href="{{ route('tickets.index') }}">Kembali ke Daftar Tiket</a>