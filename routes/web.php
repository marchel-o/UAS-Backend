<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    // return view('welcome');
    return redirect('/tickets');
});

Route::view('/register', 'auth.register')->name('register')->middleware('guest');
Route::view('/login', 'auth.login')->name('login')->middleware('guest');

Route::middleware(['auth'])->group(function(){
    Route::get('/', function(){
        return redirect('/tickets');
    })->name('tickets');

    Route::resource('tickets', TicketController::class);
});

Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
