<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\TicketHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Menampilkan daftar tiket
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'category']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        $user = Auth::user();
        if ($user->role === 'user') {
            $query->where('user_id', $user->id);
        }
        
        $tickets = $query->latest()->get();
        $categories = Category::all();

        return view('tickets.index', compact('tickets', 'categories'));
    }

    // Menampilkan form buat tiket
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    // Menyimpan tiket baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'open';

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment'] = $path;
        }

        Ticket::create($validated);

        return redirect()->route('tickets.index')->with('success', 'Laporan tiket berhasil dibuat.');
    }

    // Menampilkan detail tiket
    public function show(Ticket $ticket)
    {
        $ticket->load(['comments.user', 'category']);
        return view('tickets.show', compact('ticket'));
    }

    // Mengupdate status tiket
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed'
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status;
        $newStatus = $request->status;

        if ($oldStatus !== $newStatus) {
            $ticket->update(['status' => $newStatus]);

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'notes' => $request->notes
            ]);
        }

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Status tiket diperbarui.');
    }

    // Menghapus tiket (Admin only)
    public function destroy(Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('tickets.index')->with('error', 'Tidak memiliki izin.');
        }

        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}