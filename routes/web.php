<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ── PAGE D'ACCUEIL publique (accessible sans connexion)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ── ROUTES PROTÉGÉES
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DrinkController::class, 'dashboard'])->name('dashboard');

    Route::resource('drinks', DrinkController::class);

    Route::get('/sales',           [SaleController::class, 'index'])  ->name('sales.index');
    Route::post('/sales',          [SaleController::class, 'store'])  ->name('sales.store');
    Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');

    Route::resource('users', UserController::class);

    Route::get('/profile',    [ProfileController::class, 'edit'])   ->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update']) ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
