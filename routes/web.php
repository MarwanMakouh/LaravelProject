<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\PasswordResetController;

// 🌐 Publieke routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/games/load-more', [HomeController::class, 'loadMore'])->name('games.loadMore');
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
Route::get('/community/create', [CommunityController::class, 'create'])->name('community.create');
Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
Route::get('/community/{id}', [CommunityController::class, 'show'])->name('community.show');
Route::post('/community/{id}/comment', [CommunityController::class, 'storeComment'])->name('community.comment.store');
Route::view('/faq', 'faq.index')->name('faq.index');
Route::view('/contact', 'contact.form')->name('contact.form');

// 🎮 Game detail (met API data)
Route::get('/games/{slug}', [GamesController::class, 'show'])->name('games.show');
Route::post('/games/{slug}/comment', [GamesController::class, 'storeComment'])->name('games.comment.store');

// 🔐 Authenticatie routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 📧 Email Verificatie routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')->name('verification.resend');
});

// 🔑 Wachtwoord Reset routes
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// 👤 Profiel routes
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/me', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
});

