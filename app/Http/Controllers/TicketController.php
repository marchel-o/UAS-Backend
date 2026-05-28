<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'open';

        Ticket::create($validated);

        return redirect()->route('tickets.index')->with('success', 'Laporan tiket berhasil dibuat.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('comments.user');
        return view('tickets.show', compact('ticket'));
    }
}