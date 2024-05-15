<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post', [PostController::class, 'store'])->name('store');

Route::get('/posts', [PostController::class, 'index'])->name('posts');


Route::controller(
    AuthController::class
)->group(
    function () {
        Route::get('register', 'register')->name('register');

        Route::post('register', 'registerSave')->name('register.save');

        Route::get('login', 'login')->name('login');

        Route::post('login', 'loginAction')->name('login.action');


        Route::get('logout', 'logout')->middleware('auth')->name('logout');
    }
);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
