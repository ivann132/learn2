<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('category');
Route::get('/news/{news:slug}', [HomeController::class, 'show'])->name('news.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::middleware('auth')->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('categories', CategoryController::class);
    
    Route::resource('news', NewsController::class)->except(['show']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::redirect('/admin', '/admin/dashboard')->middleware('auth');

require __DIR__.'/auth.php';
