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

        // 2. PERBAIKAN VALIDASI UTAMA: Pindahkan cek status ke paling atas sebelum nge-cek input form!
        // strtolower digunakan agar status 'Closed', 'CLOSED', atau 'closed' semuanya terbaca dengan benar
        // JIKA DI PROJEK KALIAN STATUS SELESAI ADALAH 'resolved' atau 'selesai', GANTI KATA 'closed' DI BAWAH INI!
        $statusTiket = strtolower($ticket->status);
        if ($statusTiket !== 'closed' && $statusTiket !== 'resolved' && $statusTiket !== 'selesai') {
            return back()->with('error', 'Maaf, Anda hanya bisa memberikan rating jika status tiket sudah CLOSED / RESOLVED.');
        }

        // 3. Pastikan user yang memberi rating adalah benar-back pemilik tiket (Anti-Hacker)
        if ($ticket->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki hak untuk menilai tiket ini.');
        }

        // 4. Validasi Input Form Rating setelah status dipastikan aman
        $request->validate([
            'score' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:255',
        ]);

        // 5. Simpan atau Update Rating (Aman dari duplikasi)
        Rating::updateOrCreate(
            ['ticket_id' => $ticket->id], // Syarat unik kunci tiket
            [
                'score'   => $request->score,
                'comment' => $request->comment,
                'user_id' => Auth::id(), 
            ]
        );

        return back()->with('success', 'Terima kasih atas penilaian Anda!');
    }
}