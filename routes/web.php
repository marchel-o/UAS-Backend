<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketHistoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RatingController;

// Redirect awal langsung ke halaman login jika belum auth, atau ke tiket jika sudah
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
    
    // Fitur Tiket (User & Admin)
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::put('tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    
    // Histori, Komentar
    Route::get('tickets/{ticket}/history', [TicketHistoryController::class, 'index'])->name('tickets.history');
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
    
    // FITUR RATING (Pastikan RatingController kalian memvalidasi status 'resolved')
    Route::post('tickets/{ticket}/rate', [RatingController::class, 'store'])->name('tickets.rate');

    // Fitur Kategori
    Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store']);

    // === PENGUMUMAN SISI USER / MAHASISWA ===
    Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/pengumuman/{id}', [AnnouncementController::class, 'show'])->name('announcements.show');

    // === PENGUMUMAN SISI ADMIN (DIPROTEKSI URL-NYA) ===
    Route::prefix('admin')->name('announcements.')->group(function () {
        Route::get('/pengumuman', [AnnouncementController::class, 'adminDashboard'])->name('admin');
        Route::get('/pengumuman/create', [AnnouncementController::class, 'create'])->name('create');
        Route::post('/pengumuman', [AnnouncementController::class, 'store'])->name('store');
        Route::get('/pengumuman/{id}/edit', [AnnouncementController::class, 'edit'])->name('edit');
        Route::put('/pengumuman/{id}', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('/pengumuman/{id}', [AnnouncementController::class, 'destroy'])->name('destroy');
    });
});