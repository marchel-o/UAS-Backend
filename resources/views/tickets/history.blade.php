@extends('layouts.app')

@section('content')
<div class="container">
    <h2>History Ticket #{{ $ticket->id }}</h2>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Status Lama</th>
                        <th>Status Baru</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ticket->histories as $history)
                        <tr>
                            <td>{{ $history->created_at }}</td>
                            <td>{{ $history->user->full_name ?? '-' }}</td>
                            <td>{{ $history->old_status }}</td>
                            <td>{{ $history->new_status }}</td>
                            <td>{{ $history->notes }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada riwayat perubahan status
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('tickets.show', $ticket->id) }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection