<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::resource('tickets', TicketController::class);
Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
