<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketHistoryController extends Controller
{
    public function index($ticketId)
    {
        $ticket = Ticket::with([
            'histories.user'
        ])->findOrFail($ticketId);

        return response()->json([
            'success' => true,
            'ticket_id' => $ticket->id,
            'history' => $ticket->histories
        ]);
    }
}