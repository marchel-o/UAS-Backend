<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content']
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan.');
    }
}