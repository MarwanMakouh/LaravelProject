<?php

use Illuminate\Support\Facades\Route;

// 🌐 Publieke routes
Route::view('/', 'home')->name('home');
Route::view('/news', 'news.index')->name('news.index');
Route::view('/faq', 'faq.index')->name('faq.index');
Route::view('/contact', 'contact.form')->name('contact.form');

// 🎮 Game detail (statische mock)
Route::view('/games/{slug}', 'games.show')->name('games.show');

