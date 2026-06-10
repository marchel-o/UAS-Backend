<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\TicketHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['user', 'category'])
        ->latest()
        ->get();

        $categories = Category::all();

        return view(
        'tickets.index',
        compact('tickets', 'categories')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required|in:low,medium,high,urgent'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'open';

        Ticket::create($validated);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Laporan tiket berhasil dibuat.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load([
            'comments.user',
            'category'
        ]);

        return view('tickets.show', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed'
        ]);

        $ticket = Ticket::findOrFail($id);

        $oldStatus = $ticket->status;
        $newStatus = $request->status;

        // Simpan history hanya jika status berubah
        if ($oldStatus !== $newStatus) {

            $ticket->update([
                'status' => $newStatus
            ]);

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'notes' => $request->notes
            ]);
        }

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Status ticket berhasil diperbarui.');
    }
}