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
        // PERBAIKAN: Tambahkan relasi 'rating' agar bisa dibaca di halaman show/index dengan efisien
        $query = Ticket::with(['user', 'category', 'rating']);

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
        $user = Auth::user();

        // PERBAIKAN KEAMANAN: Jika yang login adalah user biasa, pastikan dia HANYA bisa melihat tiket miliknya sendiri!
        if ($user->role === 'user' && $ticket->user_id !== $user->id) {
            abort(403, 'Akses ditolak! Anda tidak berhak melihat tiket ini.');
        }

        // PERBAIKAN: Load juga relasi 'rating' agar form rating di blade bisa mendeteksi apakah tiket sudah dinilai
        $ticket->load(['comments.user', 'category', 'rating']);
        return view('tickets.show', compact('ticket'));
    }

    // Mengupdate status tiket
    public function update(Request $request, $id)
    {
        // PERBAIKAN KEAMANAN: Pastikan HANYA admin yang boleh mengganti status tiket!
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('tickets.index')->with('error', 'Akses ditolak! Anda bukan Admin.');
        }

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