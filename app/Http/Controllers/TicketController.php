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
        // 1. Inisialisasi Query dengan Relasi
        $query = Ticket::with(['user', 'category']);

        // 2. Filter berdasarkan Kategori (jika dipilih)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        // 3. Filter berdasarkan Role (Admin lihat semua, User hanya lihat milik sendiri)
        $user = Auth::user();
        if ($user->role === 'user') {
            $query->where('user_id', $user->id);
        }
        
        // 4. Eksekusi query dengan urutan terbaru
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

    // Menyimpan tiket baru ke database
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

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Status tiket berhasil diperbarui.');
    }
}