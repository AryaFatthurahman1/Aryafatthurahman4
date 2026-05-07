<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TransactionController::class, 'index'])->name('home');
Route::resource('barang', BarangController::class);
Route::resource('transaksi', TransactionController::class);
