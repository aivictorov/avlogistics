<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

// Route::view('/', 'site.index');
// Route::redirect('/test', '/', 301);

Route::get('/', HomeController::class);

Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
Route::get('/{page}', [PageController::class, 'show'])->name('pages.show')->where('page', '.+');
Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

// Route::resource('/pages', PageController::class);
// Route::resource('/pages', PageController::class)->only(['index', 'show']);

Route::get('/admin', HomeController::class);


Route::fallback(function () {
    return "404";
});
