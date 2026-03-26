<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ThisOrThatController;
use App\Http\Controllers\Auth\GuestController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('welcome');
});

Route::post('/guest', [GuestController::class, 'store'])->name('guest.login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/games/create', [GameController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('games.create');

// This or that
Route::get('/games/this-or-that/create', [ThisOrThatController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('games.this-or-that.create');

Route::post('/games/this-or-that/store', [ThisOrThatController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('games.this-or-that.store');

Route::get('/games/this-or-that/{userGame}/edit', [ThisOrThatController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('games.this-or-that.edit');

Route::put('/games/this-or-that/{userGame}', [ThisOrThatController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('games.this-or-that.update');

Route::delete('/games/{userGame}', [ThisOrThatController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('games.destroy');

Route::get('/games/this-or-that/{userGame}/play', [ThisOrThatController::class, 'play'])
    ->middleware(['auth', 'verified'])
    ->name('games.this-or-that.play');

// Legal
Route::view('/privacy-policy', 'legal.legal')->name('privacy.policy');

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/legal', 'legal.legal')->name('legal');
});

Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirect'])
    ->whereIn('provider', ['google','facebook'])->name('oauth.redirect');

Route::get('/auth/{provider}/callback', [OAuthController::class, 'callback'])
    ->whereIn('provider', ['google','facebook'])->name('oauth.callback');

require __DIR__.'/auth.php';
