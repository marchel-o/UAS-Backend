<h1>Daftar Tiket Laporan</h1>
<a href="{{ route('tickets.create') }}">Buat Tiket Baru</a>
<table border="1" cellpadding="10" style="margin-top: 10px; border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Prioritas</th>
        <th>Status</th>
        <th>Aksi</th>
        <th>Kategori</th>
    </tr>
    @foreach($tickets as $ticket)
    <tr>
        <td>{{ $ticket->id }}</td>
        <td>{{ $ticket->title }}</td>
        <td>{{ $ticket->priority }}</td>
        <td>{{ $ticket->status }}</td>
        <td><a href="{{ route('tickets.show', $ticket->id) }}">Detail</a></td>
        <td>{{ $ticket->category->name ?? '-' }}</td>
    </tr>
    @endforeach
</table>