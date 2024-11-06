<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/login', function () {
    return view('app');
})->name('login');

Route::get('/', function () {return view('app'); })->name('home');

Route::get('/calendar', function () {
    return view('app');
})->name('calendar')->middleware('auth');
Route::get('/setting', function () {
    return view('app');
})->name('setting')->middleware('auth');

Route::resource('posts', PostController::class)->except(['index']);
