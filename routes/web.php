<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\penyimpanan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', [LoginController::class, 'show_login'])->name('login'); 

Route::get('/register', [RegisterController::class, 'show_register'])->name('register');
Route::post('/register-process', [RegisterController::class, 'register_validate'])->name('register.validate');

// Proses Login (Action dari Form Login)
Route::post('/login-process', [LoginController::class, 'login_validate'])->name('login.validate');

// --- BAGIAN PRIVATE (Harus Login dulu) ---
Route::middleware(['auth'])->group(function () {
    
    // Route Dashboard/Beranda
    Route::get('/dashboard', function () {
        return view('beranda'); // Pastikan nama filenya beranda.blade.php
    })->name('dashboard');

    // Route Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // === Route Inventory Kamu (Semua dipindah ke sini) ===
    Route::get('/penyimpanan', [penyimpanan::class, 'index'])->name('penyimpanan.index');
    Route::get('/ambil-item', [penyimpanan::class, 'create'])->name('get.item');
    Route::post('/simpan-penyimpanan', [penyimpanan::class, 'store'])->name('penyimpanan.store');
    Route::get('/penyimpanan/{id}/edit', [penyimpanan::class, 'edit'])->name('penyimpanan.edit');
    Route::put('/penyimpanan/{id}', [penyimpanan::class, 'update'])->name('penyimpanan.update');
    Route::delete('/penyimpanan/{id}', [penyimpanan::class, 'destroy'])->name('penyimpanan.destroy');

    Route::get('/items', [ItemController::class, 'index'])->name('item.index');
    Route::get('/Riwayat_items', [ItemController::class, 'riwayat_index'])->name('item.riwayat_index');
    Route::post('/items/{id}/restore', [ItemController::class, 'Restore'])->name('item.restore');
    
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

    Route::get('/tambah-item', [KategoriController::class, 'create'])->name('item.tambah');
    Route::post('/simpan-item', [ItemController::class, 'store'])->name('item.store');
});








