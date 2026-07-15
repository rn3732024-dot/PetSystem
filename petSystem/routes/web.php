<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/pets', [DashboardController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('pets.store');

Route::get('/pets/{pet}/edit', [DashboardController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('pets.edit');

Route::put('/pets/{pet}', [DashboardController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('pets.update');

Route::delete('/pets/{pet}', [DashboardController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('pets.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
