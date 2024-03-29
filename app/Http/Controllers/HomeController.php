<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;


class HomeController extends Controller
{
    public function __invoke()
    {
        return view('site.home');
    }
}
