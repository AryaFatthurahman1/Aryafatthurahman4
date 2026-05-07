<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\OtentikasiController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('beranda');
})->name('home');

Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::view('/asisten-ai', 'asisten-ai')->name('asisten-ai');
Route::view('/reservasi', 'reservasi')->name('reservasi');

// New Reservation Flow
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');

// Auth Routes
Route::get('/masuk', [OtentikasiController::class, 'login'])->name('login');
Route::post('/masuk', [OtentikasiController::class, 'postLogin'])->name('login.post');
Route::get('/daftar', [OtentikasiController::class, 'register'])->name('register');
Route::post('/daftar', [OtentikasiController::class, 'postRegister'])->name('register.post');
Route::post('/keluar', [OtentikasiController::class, 'logout'])->name('logout');
