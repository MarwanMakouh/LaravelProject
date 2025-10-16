<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\GamesController;

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

