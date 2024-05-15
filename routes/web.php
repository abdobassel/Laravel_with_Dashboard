<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\PostController;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
    return view('welcome');
});


//// test posts
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post', [PostController::class, 'store'])->name('store');

Route::get('/posts', [PostController::class, 'index'])->name('posts');
/////

Route::controller(
    AuthController::class
)->middleware('guest')->group(
    function () {
        Route::get('register', 'register')->name('register');

        Route::post('register', 'registerSave')->name('register.save');

        Route::get('login', 'login')->name('login');

        Route::post('login', 'loginAction')->name('login.action');
    }
);

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/{userid}', [AuthController::class, 'updateProfile'])->name('profile.update');
});
