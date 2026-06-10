<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketHistoryController extends Controller
{
    public function index($ticketId)
    {
        $ticket = Ticket::with([
            'histories.user'
        ])->findOrFail($ticketId);

        return view('tickets.history', compact('ticket'));
    }
}