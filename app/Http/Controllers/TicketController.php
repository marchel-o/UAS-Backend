<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'category']);

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $user = Auth::user();
        
        if ($user->role === 'user'){
            $query->where('user_id', $user->id)->latest()->get();
        } else{
            $query->latest()->get();
        }
        
        $tickets = $query->latest()->get();
        $categories = Category::all();

        return view('tickets.index', compact('tickets', 'categories'));
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

        return redirect()->route('tickets.index')->with('success', 'Laporan tiket berhasil dibuat.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['comments.user', 'category']);
        return view('tickets.show', compact('ticket'));
    }
}