<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', App\Http\Controllers\Admin\HomeController::class)->name('home');

    Route::get('/pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [App\Http\Controllers\Admin\PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{page}/edit', [App\Http\Controllers\Admin\PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [App\Http\Controllers\Admin\PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{page}', [App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('pages.destroy');
});

Route::name('user.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'create'])->name('create');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

Route::get('/', HomeController::class)->name('home');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');

Route::get('/faq', [FAQController::class, 'index'])->name('portfolio.index');

Route::get('/contact', ContactFormController::class)->name('contactForm');

Route::get('/{page}', [PageController::class, 'show'])->where('page', '.+')->name('pages.show');