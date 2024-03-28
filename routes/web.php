<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', HomeController::class)->name('main');
Route::redirect('/index', '/', 301);

Route::name('user.')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])->name('auth');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/register', [RegisterController::class, 'create'])->name('create');
    Route::post('/register', [RegisterController::class, 'store'])->name('store');
});

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('main');

    Route::get('/admin/pages', [AdminController::class, 'show'])->name('pages.index');
    Route::get('/admin/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/admin/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/admin/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

    Route::get('/admin/portfolio', [AdminController::class, 'show'])->name('portfolio.index');
    Route::get('/admin/faq', [AdminController::class, 'show'])->name('faq.index');
});

Route::get('/{page}', [PageController::class, 'show'])->name('pages.show')->where('page', '.+');

// Route::resource('/pages', PageController::class);
// Route::resource('/pages', PageController::class)->only(['index', 'show']);

Route::fallback(function () {
    return "404";
});
