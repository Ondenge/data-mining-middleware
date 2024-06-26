<?php

use App\Http\Controllers\CtKhisController;
use App\Http\Controllers\Fy23DatimController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/ct-khis', [CtKhisController::class, 'index']);
Route::get('/ct-khis/reprocess', [CtKhisController::class, 'reprocess']);

Route::get('/fy23-datim', [Fy23DatimController::class, 'index']);
Route::get('/fy23-datim/reprocess', [Fy23DatimController::class, 'reprocess']);

require __DIR__.'/auth.php';
