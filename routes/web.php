<?php

use App\Http\Controllers\PelamarController;
use Illuminate\Support\Facades\Route;

// Halaman Form
Route::get('/', function () {
    return view('welcome');
});

// Proses Simpan Data
Route::post('/daftar', [PelamarController::class, 'store'])->name('pelamar.store');