<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketHistoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RatingController;

// Redirect awal
Route::get('/', function () {
    return redirect()->route('tickets.index');
});

// ========================================================
// GRUP ROUTE GUEST (BELUM LOGIN)
// ========================================================
Route::middleware('guest')->group(function () {
    Route::get('login', [UserController::class, 'showLogin'])->name('login');
    Route::post('login', [UserController::class, 'login']);
    Route::get('register', [UserController::class, 'showRegister'])->name('register');
    Route::post('register', [UserController::class, 'register']);
});

// ========================================================
// GRUP ROUTE AUTH (SUDAH LOGIN)
// ========================================================
Route::middleware('auth')->group(function () {
    
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    
    // Fitur Tiket
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::put('tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    
    // TAMBAHKAN RUTE INI UNTUK HAPUS TIKET
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    
    // Histori, Komentar, & Rating
    Route::get('tickets/{ticket}/history', [TicketHistoryController::class, 'index'])->name('tickets.history');
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('tickets/{ticket}/rate', [RatingController::class, 'store'])->name('tickets.rate');

    // Fitur Kategori
    Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store']);

    // Pengumuman & Admin Pengumuman (Sesuai kode asli Anda)
    Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/pengumuman/{id}', [AnnouncementController::class, 'show'])->name('announcements.show');

    Route::get('/admin/pengumuman', [AnnouncementController::class, 'adminDashboard'])->name('announcements.admin');
    Route::get('/admin/pengumuman/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/admin/pengumuman', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/admin/pengumuman/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/admin/pengumuman/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/admin/pengumuman/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});