<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavoriteGameController;

// 🌐 Publieke routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/games/load-more', [HomeController::class, 'loadMore'])->name('games.loadMore');
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
Route::get('/community/create', [CommunityController::class, 'create'])->name('community.create');
Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
Route::get('/community/{id}', [CommunityController::class, 'show'])->name('community.show');
Route::post('/community/{id}/comment', [CommunityController::class, 'storeComment'])->name('community.comment.store');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// 📰 News routes (public)
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

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

// 🔐 Admin routes (news & faq management)
// ⭐ Favoriete games routes
Route::middleware('auth')->group(function () {
    Route::post('/favorites', [FavoriteGameController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites', [FavoriteGameController::class, 'destroy'])->name('favorites.destroy');
});

// 🔐 Admin routes (news management)
Route::middleware('auth')->prefix('admin')->group(function () {
    // News management
    Route::get('/news', [NewsController::class, 'adminIndex'])->name('admin.news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    // FAQ management
    Route::get('/faq', [FaqController::class, 'adminIndex'])->name('admin.faq.index');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/faq/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faq/{id}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
});

