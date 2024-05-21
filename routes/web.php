<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', function () {
        return view('dashboard');
    })->middleware(AdminMiddleware::class)->name('dashboard');
    // admin profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/{userid}', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/dashboard/products', [ProductController::class, 'index'])->middleware(AdminMiddleware::class)->name('admin.products');
    Route::get('/dashboard/product/create', [ProductController::class, 'create'])->middleware(AdminMiddleware::class)->name('admin.product.create');
    Route::post('/dashboard/products', [ProductController::class, 'store'])->name('admin.product.store');

    Route::get('/dashboard/products/edit/{productid}', [ProductController::class, 'edit'])->middleware(AdminMiddleware::class)->name('admin.product.edit');
    Route::post('/dashboard/products/edit/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/dashboard/products/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');


    // admin categories
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->middleware(AdminMiddleware::class)->name('admin.categories');
    Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->middleware(AdminMiddleware::class)->name('admin.category.create');
    Route::post('/dashboard/category/create', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/dashboard/categories/edit/{categoryid}', [CategoryController::class, 'edit'])->middleware(AdminMiddleware::class)->name('admin.category.edit');
    Route::delete('/dashboard/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    //  users dashboard
    Route::get('/dashboard/users', [DashboardController::class, 'getUsers'])->middleware(AdminMiddleware::class)->name('admin.users');
    Route::get('/dashboard/admins', [DashboardController::class, 'getAdmins'])->middleware(AdminMiddleware::class)->name('admin.admins');
});
