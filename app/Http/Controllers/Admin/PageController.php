<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store()
    {
        return 'Сохранение страницы';
    }

    public function edit()
    {
        return 'Редактирование страницы';
    }

    public function update()
    {
        return 'Изменение страницы';
    }

    public function destroy()
    {
        return 'Удаление страницы';
    }
    





}
