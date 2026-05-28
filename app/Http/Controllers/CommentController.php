<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $ticketId)
    {
        $request->validate(['content' => 'required']);

        Comment::create([
            'ticket_id' => $ticketId,
            'user_id' => 1,
            'content' => $request->content
        ]);

        return back();
    }
}
