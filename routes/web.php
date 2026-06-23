<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketHistoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::put('tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    
    Route::get('tickets/{ticket}/history', [TicketHistoryController::class, 'index'])->name('tickets.history');
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('tickets/{ticket}/rate', [RatingController::class, 'store'])->name('tickets.rate');  
  
    Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('faqs', FAQController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/pengumuman/{id}', [AnnouncementController::class, 'show'])->name('announcements.show');

    Route::prefix('admin')->name('announcements.')->group(function () {
        Route::get('/pengumuman', [AnnouncementController::class, 'adminDashboard'])->name('admin');
        Route::get('/pengumuman/create', [AnnouncementController::class, 'create'])->name('create');
        Route::post('/pengumuman', [AnnouncementController::class, 'store'])->name('store');
        Route::get('/pengumuman/{id}/edit', [AnnouncementController::class, 'edit'])->name('edit');
        Route::put('/pengumuman/{id}', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('/pengumuman/{id}', [AnnouncementController::class, 'destroy'])->name('destroy');
    });
    
    Route::get('users', [RoleController::class, 'index'])->name('users.index');
    Route::put('users/update-role', [RoleController::class, 'update'])->name('role.update');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get(
        '/tickets/{id}/history',
        [TicketHistoryController::class, 'index']
    )->name('tickets.history');
});