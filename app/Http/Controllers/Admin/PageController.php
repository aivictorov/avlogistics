<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SEO;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Images;

Images::configure(['driver' => 'imagick']);

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::select('id', 'name', 'url', 'update_date', 'status')->orderBy('id')->get()->toArray();

        foreach ($pages as $key => $page) {
            $pages[$key]['update_date'] = Carbon::parse($page['update_date'])->toDateString();
        }

        return view('admin.pages.index', compact('pages'));
    }

    public function create(Request $request)
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        if (!$request->filled('url')) {
            $request->merge([
                'url' => Str::slug($request->input('name')),
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string'],
            'h1' => ['required', 'string'],
            'url' => ['required', 'string'],
            'text' => ['required'],
        ]);

        $validated = array_merge($validated, [
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

        $page = Page::create($validated);

        if ($page && $request->filled('image')) {
            $request->validate([
                'image' => ['mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=270'],
            ]);

            $parent_type = 'page_avatar';
            $parent_id = $page->id;

            $image = Images::make($request->file('image'));
            $image->fit(670, 270);

            $watermark = Images::make(public_path('images/watermark.png'));
            $image->insert($watermark, 'center');

            $mini_watermark = Images::make(public_path('images/mini-watermark.png'));
            $image->insert($mini_watermark, 'bottom-right');

            $original_filename = $request->file('image')->getClientOriginalName();

            $imageDB = Image::create([
                'image' => $original_filename,
                'create_date' => Carbon::now()->toDateTimeString(),
                'sort' => 0,
                'parent_type' => $parent_type,
                'parent_id' => $parent_id,
            ]);

            Storage::makeDirectory('public/upload/page_avatar/' . $parent_id . '/' . $imageDB->id . '/original');
            Storage::makeDirectory('public/upload/page_avatar/' . $parent_id . '/' . $imageDB->id . '/sizes');

            $image_path = storage_path('app/public/upload/page_avatar/' . $parent_id . '/' . $imageDB->id . '/sizes/' . 'page_' . $original_filename);
            $image->save($image_path);
        }

        return redirect(route('admin.pages.index'));
    }

    public function edit($id)
    {
        $page = Page::find($id);
        $seo = SEO::find($page['seo_id']);
        return view('admin.pages.edit', compact('page', 'seo'));
    }

    public function update()
    {
        return 'Изменение страницы';
    }

    public function destroy($id)
    {
        Page::find($id)->delete();
        return redirect(route('admin.pages.index'));
    }
}
