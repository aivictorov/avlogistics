<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::view('/', 'main.index');

Route::redirect('/test', '/', 301);

Route::get('/home', HomeController::class);

// Route::get('/posts', [PostController::class, 'index']);

Route::fallback(function () {
    return "404";
});
