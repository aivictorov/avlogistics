<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $pages_count = Page::all()->count();
        $users_count = User::all()->count();

        return view('admin.home', compact('pages_count', 'users_count'));
    }
}
