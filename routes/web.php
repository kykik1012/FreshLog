<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\penyimpanan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {return view('LoginPage');});

Route::get('/penyimpanan', [penyimpanan::class, 'index'])->name('penyimpanan.index');

Route::get('/ambil-item', [penyimpanan::class, 'create'])->name('get.item');

Route::post('/simpan-penyimpanan', [penyimpanan::class, 'store'])->name('penyimpanan.store');

Route::get('/penyimpanan/{id}/edit', [penyimpanan::class, 'edit'])->name('penyimpanan.edit');

Route::put('/penyimpanan/{id}', [penyimpanan::class, 'update'])->name('penyimpanan.update');

Route::get('/items', [ItemController::class, 'index'])->name('item.index');

Route::get('/Riwayat_items', [ItemController::class, 'riwayat_index'])->name('item.riwayat_index');

Route::delete('/penyimpanan/{id}', [penyimpanan::class, 'destroy'])->name('penyimpanan.destroy');

Route::post('/items/{id}/restore', [ItemController::class, 'Restore'])->name('item.restore');
Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

Route::get('/tambah-item', [KategoriController::class, 'create'])->name('item.tambah');
Route::post('/simpan-item', [ItemController::class, 'store'])->name('item.store');

Route::get('login', [LoginController::class, 'show_login'])-> name('login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])-> name('dashboard'); //supaya user yang belom login ga bisa ke dashboard


    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});








