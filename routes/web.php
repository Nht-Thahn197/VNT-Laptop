<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LaptopController as AdminLaptopController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/laptops', [LaptopController::class, 'index'])->name('laptops.index');
Route::get('/laptops/{laptop}', [LaptopController::class, 'show'])->name('laptops.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/lien-he', [ContactController::class, 'show'])->name('contact.show');
Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('auth.login')->middleware('guest');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('auth.login.submit')->middleware('guest');
Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('auth.register')->middleware('guest');
Route::post('/dang-ky', [AuthController::class, 'register'])->name('auth.register.submit')->middleware('guest');
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('laptops', AdminLaptopController::class)->except(['show']);
    Route::resource('posts', AdminPostController::class)->except(['show']);

    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
});
