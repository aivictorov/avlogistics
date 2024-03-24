<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'contacts']);

Route::get('/admin_panel', function () {
    return view('admin.index'); 
});

