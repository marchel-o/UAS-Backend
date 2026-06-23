@extends('layouts.app')

@section('content')
<div style="padding: 1rem;">
    <h2>Dashboard Statistik</h2>
    <p>Ringkasan data operasional Helpdesk Kampus.</p>

    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
        <div style="border: 1px solid #ccc; padding: 1rem; border-radius: 5px; flex: 1; min-width: 150px; text-align: center;">
            <h3 style="margin-top: 0; font-size: 1.1rem; color: #555;">Total Tiket</h3>
            <p style="font-size: 2.5rem; margin: 0; font-weight: bold;">{{ $totalTickets }}</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 1rem; border-radius: 5px; flex: 1; min-width: 150px; text-align: center;">
            <h3 style="margin-top: 0; font-size: 1.1rem; color: #555;">Total Pengguna</h3>
            <p style="font-size: 2.5rem; margin: 0; font-weight: bold;">{{ $totalUsers }}</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 1rem; border-radius: 5px; flex: 1; min-width: 150px; text-align: center;">
            <h3 style="margin-top: 0; font-size: 1.1rem; color: #555;">Total Kategori</h3>
            <p style="font-size: 2.5rem; margin: 0; font-weight: bold;">{{ $totalCategories }}</p>
        </div>
    </div>

    <div style="border: 1px solid #ccc; padding: 1rem; border-radius: 5px;">
        <h3 style="margin-top: 0;">Rincian Status Tiket</h3>
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @forelse($ticketsByStatus as $stat)
                <li style="border-bottom: 1px solid #eee; padding: 0.75rem 0; display: flex; justify-content: space-between;">
                    <strong>Status: {{ strtoupper($stat->status) }}</strong> 
                    <span>{{ $stat->total }} Tiket</span>
                </li>
            @empty
                <li style="padding: 0.5rem 0; color: #777;">Belum ada data tiket.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection