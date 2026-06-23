<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $user = Auth::user();

        // PERBAIKAN KEAMANAN: Cek hak akses sebelum menyimpan komentar
        // Jika yang login bukan admin DAN bukan pemilik tiket, langsung blokir!
        if ($user->role !== 'admin' && $ticket->user_id !== $user->id) {
            return back()->with('error', 'Akses ditolak! Anda tidak diizinkan berkomentar di tiket ini.');
        }

        // Validasi input komentar
        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        // Simpan komentar ke database
        $ticket->comments()->create([
            'user_id' => $user->id,
            'content' => $validated['content']
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}