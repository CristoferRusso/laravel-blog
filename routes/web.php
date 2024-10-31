<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;


Route::get('/{any}', function () {
    return view('app'); // questa view sarà la root dell'app Vue
})->where('any', '.*');


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/about', [HomeController::class, 'about'])->name('about')->middleware('auth.check');

Route::resource('posts', PostController::class)->except(['index',  ]);



 