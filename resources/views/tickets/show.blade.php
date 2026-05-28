<h1>{{ $ticket->title }}</h1>
<p><strong>Status:</strong> {{ $ticket->status }}</p>
<p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>
<br>
<a href="{{ route('tickets.index') }}">Kembali ke Daftar Tiket</a>