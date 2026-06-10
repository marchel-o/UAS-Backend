<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketHistoryController;

Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [UserController::class, 'showLogin'])->name('login');
    Route::post('login', [UserController::class, 'login']);
    Route::get('register', [UserController::class, 'showRegister'])->name('register');
    Route::post('register', [UserController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store']);
    Route::get(
        '/tickets/{id}/history',
        [TicketHistoryController::class, 'index']
    )->name('tickets.history');
    });