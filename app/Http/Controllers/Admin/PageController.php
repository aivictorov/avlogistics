<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Page;
use Intervention\Image\ImageManagerStatic as Image;

Image::configure(['driver' => 'imagick']);

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function create(Request $request)
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'mimes:jpg,jpeg', 'dimensions:min_width=600,min_height=400'],
        ]);

        $image = Image::make($request->file('image'));
        $image_path = storage_path('app\public\upload\header.jpg');

        $image->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image->save($image_path);

        dd($image);


        $path = $request->file('image')->storeAs(
            'upload/avatars',
            $request->image()->id
        );


        $validatedFields = $request->validate([
            'name' => ['required', 'string'],
            'h1' => ['required', 'string'],
            'url' => ['required', 'string'],
            "text" => [],
        ]);

        $validatedFields = array_merge($validatedFields, [
            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => 1,
            "parent_id" => 3,
            "menu_sort" => 0,
            'menu_show' => 1,
            'status' => 1,
            'system' => 0,
            'system_page' => 0,
            'seo_id' => 9,
            'portfolio_section_id' => null,
        ]);

        $page = Page::create($validatedFields);

        if ($page) {
            return redirect(route('admin.pages.index'));
        }

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
