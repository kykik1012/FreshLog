<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\penyimpanan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;

Route::get('/', [LoginController::class, 'show_login'])->name('login'); 

Route::get('/register', [RegisterController::class, 'show_register'])->name('register');
Route::post('/register-process', [RegisterController::class, 'register_validate'])->name('register.validate');

// Proses Login (Action dari Form Login)
Route::post('/login-process', [LoginController::class, 'login_validate'])->name('login.validate');

// (Harus Login dulu bang AOWKOAWKOAWKAOWKK ) ---
Route::middleware(['auth'])->group(function () {
    
    // Route Dashboard/Beranda
    Route::get('/dashboard', function () {
        return view('beranda'); 
    })->name('dashboard');

    // Route Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/ShowProfile', [ProfileController::class, 'show_profile'])-> name('Show.Profile');
    Route::get('/Edit-Profile', [ProfileController::class, 'show_edit'])-> name('Edit-Profile');
    Route::post('/dashboard/{username}/edit', [ProfileController::class, 'edited'])->name('Edit-Profile');
    Route::get('/secure', [ProfileController::class, 'show_secure'])-> name('secure');
    Route::post('change-password', [ProfileController::class, 'change_password'])-> name('change-password');


    // === Route Inventory Kamu (Semua dipindah ke sini) ===
    Route::get('/penyimpanan', [penyimpanan::class, 'index'])->name('penyimpanan.index');
    Route::get('/ambil-item', [penyimpanan::class, 'create'])->name('get.item');
    Route::post('/simpan-penyimpanan', [penyimpanan::class, 'store'])->name('penyimpanan.store');
    Route::get('/penyimpanan/{id}/edit', [penyimpanan::class, 'edit'])->name('penyimpanan.edit');
    Route::put('/penyimpanan/{id}', [penyimpanan::class, 'update'])->name('penyimpanan.update');
    Route::delete('/penyimpanan/{id}', [penyimpanan::class, 'destroy'])->name('penyimpanan.destroy');
    Route::get('/penyimpanan/riwayat', [penyimpanan::class, 'history'])->name('penyimpanan.history');

    Route::get('/items', [ItemController::class, 'index'])->name('item.index');
    Route::get('/Riwayat_items', [ItemController::class, 'riwayat_index'])->name('item.riwayat_index');
    Route::post('/items/{id}/restore', [ItemController::class, 'Restore'])->name('item.restore');
    
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

    Route::get('/tambah-item', [KategoriController::class, 'create'])->name('item.tambah');
    Route::post('/simpan-item', [ItemController::class, 'store'])->name('item.store');
});








