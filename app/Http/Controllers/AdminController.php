<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $pages_count = Page::all()->count();
        $users_count = User::all()->count();

        return view('admin.site.index', compact('pages_count', 'users_count'));
    }

    public function show()
    {
        return view('admin.site.page');
    }

}
