<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }

        $totalTickets = Ticket::count();
        $totalUsers = User::count();
        $totalCategories = Category::count();

        $ticketsByStatus = Ticket::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get();

        return view('dashboard.index', compact(
            'totalTickets',
            'totalUsers',
            'totalCategories',
            'ticketsByStatus'
        ));
    }
}
