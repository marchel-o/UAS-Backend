<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketHistoryController;
use App\Http\Controllers\AnnouncementController;

// Halaman utama otomatis dialihkan ke daftar tiket
Route::get('/', function () {
    return redirect()->route('tickets.index');
});

// ========================================================
// GRUP ROUTE UNTUK YANG BELUM LOGIN (GUEST)
// ========================================================
Route::middleware('guest')->group(function () {
    Route::get('login', [UserController::class, 'showLogin'])->name('login');
    Route::post('login', [UserController::class, 'login']);
    Route::get('register', [UserController::class, 'showRegister'])->name('register');
    Route::post('register', [UserController::class, 'register']);
});

// ========================================================
// GRUP ROUTE UNTUK YANG SUDAH LOGIN (AUTH)
// ========================================================
Route::middleware('auth')->group(function () {
    
    // Fitur Autentikasi
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    
    // Fitur Tiket & Komentar
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Fitur Kategori & Histori Tiket
    Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store']);
    Route::get('/tickets/{id}/history', [TicketHistoryController::class, 'index'])->name('tickets.history');

    // ========================================================
    // 📢 FITUR PENGUMUMAN / INFO KAMPUS
    // ========================================================
    
    // Sisi User (Mahasiswa/Staff) untuk melihat info
    Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/pengumuman/{id}', [AnnouncementController::class, 'show'])->name('announcements.show');

    // Sisi Admin untuk mengelola info (CRUD Lengkap)
    Route::get('/admin/pengumuman', [AnnouncementController::class, 'adminDashboard'])->name('announcements.admin');
    Route::get('/admin/pengumuman/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/admin/pengumuman', [AnnouncementController::class, 'store'])->name('announcements.store');
    
    // Rute Edit & Hapus (WAJIB ADA agar tidak error RouteNotFound)
    Route::get('/admin/pengumuman/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/admin/pengumuman/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/admin/pengumuman/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});