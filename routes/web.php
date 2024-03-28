<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

Route::get('/', HomeController::class)->name('main');
Route::redirect('/index', '/', 301);

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authentificate'])->name('authentificate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registration', [RegistrationController::class, 'registration'])->name('registration');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');

Route::middleware('auth')->name('admin.')->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('index');
    Route::get('/admin/page', [AdminController::class, 'show'])->name('page');
});

Route::get('/{page}', [PageController::class, 'show'])->name('pages.show')->where('page', '.+');

// Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
// Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
// Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
// Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
// Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
// Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

// Route::resource('/pages', PageController::class);
// Route::resource('/pages', PageController::class)->only(['index', 'show']);

Route::fallback(function () {
    return "404";
});
