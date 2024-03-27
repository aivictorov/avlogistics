<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.site.index');
    }

    public function show()
    {
        return view('admin.site.page');
    }

}
