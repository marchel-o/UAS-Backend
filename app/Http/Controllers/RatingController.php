<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $ticketId)
    {
        // 1. Cari tiket berdasarkan ID
        $ticket = Ticket::findOrFail($ticketId);

        // 2. Validasi Input
        $request->validate([
            'score' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:255',
        ]);

        // 3. Cek apakah status tiket sudah 'closed' 
        // (Pastikan ini sama dengan status yang digunakan di TicketController)
        if ($ticket->status !== 'closed') {
            return back()->with('error', 'Anda hanya bisa memberi rating jika status tiket sudah closed.');
        }

        // 4. Pastikan user yang memberi rating adalah pemilik tiket
        if ($ticket->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki hak untuk menilai tiket ini.');
        }

        // 5. Simpan atau Update Rating (menggunakan updateOrCreate agar aman dari error duplikasi)
        Rating::updateOrCreate(
            ['ticket_id' => $ticket->id], // Syarat unik
            [
                'score'   => $request->score,
                'comment' => $request->comment,
                'user_id' => Auth::id(), // Opsional: jika tabel rating butuh user_id
            ]
        );

        return back()->with('success', 'Terima kasih atas penilaian Anda!');
    }
}