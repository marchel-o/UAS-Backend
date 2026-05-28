<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [UserController::class, 'showLogin'])->name('login');
    
    Route::post('login', [UserController::class, 'login'])->name('user.login'); 
    
    Route::get('register', [UserController::class, 'showRegister'])->name('register');
    
    Route::post('register', [UserController::class, 'register'])->name('user.register'); 
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    
    Route::resource('tickets', TicketController::class);
    
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
});