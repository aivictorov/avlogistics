<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\PortfolioSectionController;
use App\Http\Controllers\UserController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', App\Http\Controllers\Admin\HomeController::class)->name('home');

    Route::get('/pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [App\Http\Controllers\Admin\PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [App\Http\Controllers\Admin\PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}', [App\Http\Controllers\Admin\PageController::class, 'update'])->name('pages.update');
    Route::get('/pages/{id}/delete', [App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('pages.destroy');
    // Route::delete('/pages/{id}', [App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('pages.destroy');

    Route::get('/portfolio', [App\Http\Controllers\Admin\PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/create', [App\Http\Controllers\Admin\PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [App\Http\Controllers\Admin\PortfolioController::class, 'store'])->name('portfolio.store');

    Route::get('/portfolioSections', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'index'])->name('portfolioSections.index');
    Route::get('/portfolioSections/create', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'create'])->name('portfolioSections.create');
    Route::post('/portfolioSections', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'store'])->name('portfolioSections.store');

    Route::get('/faq', [App\Http\Controllers\Admin\FAQController::class, 'index'])->name('faq.index');
    Route::get('/faq/create', [App\Http\Controllers\Admin\FAQController::class, 'create'])->name('faq.create');
    Route::post('/faq', [App\Http\Controllers\Admin\FAQController::class, 'store'])->name('faq.store');

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/{id}/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
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