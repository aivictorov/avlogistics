<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SEO;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $pages = Page::select('id', 'name', 'url', 'update_date', 'status')->orderBy('id')->get()->toArray();

        return view('admin.pages.create', compact('pages'));
    }

    public function store(Request $request)
    {
        if (!$request->filled('url')) {
            $request->merge([
                'url' => Str::slug($request->input('name')),
            ]);
        }

        $validated = $request->validate(array_merge(Page::getRules(), SEO::getRules(), Image::getRules()));

        $validated = array_merge($validated, [
            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
            'system' => 0,
            'portfolio_section_id' => null,
        ]);

        DB::transaction(function () use ($validated, $request) {
            $seo = SEO::create($validated);
            $validated = array_merge($validated, ['seo_id' => $seo->id]);

            $page = Page::create($validated);

            if ($request->has('image')) {
                $image = Image::create([
                    'image' => $request->file('image')->getClientOriginalName(),
                    'create_date' => Carbon::now()->toDateTimeString(),
                    'sort' => 0,
                    'parent_type' => 'page_avatar',
                    'parent_id' => $page->id,
                ]);

                Image::savePageAvatar($request->file('image'), $image->id, $page->id);
            }
        }, 3);
        return redirect(route('admin.pages.index'));
    }

    public function edit($id)
    {
        $page = Page::find($id);

        $image = Image::where([
            ['parent_type', 'page_avatar'],
            ['parent_id', $id],
        ])->first();

        if ($image) {
            $image_path = '/storage/upload/page_avatar/' . $id . '/' . $image['id'] . '/sizes/page_' . $image['image'];
        } else {
            $image_path = '';
        }

        $seo = SEO::find($page['seo_id']);

        $pages = Page::select('id', 'name', 'url', 'update_date', 'status')->orderBy('id')->get()->toArray();

        return view('admin.pages.edit', compact('page', 'image_path', 'seo', 'pages'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->filled('url')) {
            $request->merge([
                'url' => Str::slug($request->input('name')),
            ]);
        }

        $validated = $request->validate(array_merge(Page::getRules(), SEO::getRules(), Image::getRules()));

        $validated = array_merge($validated, [
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);

        $page = Page::find($id);
        $seo = SEO::find($page['seo_id']);

        DB::transaction(function () use ($page, $seo, $validated, $request, $id) {
            $page->update($validated);
            $seo->update($validated);

            if ($request->has('image')) {
                $image = Image::where([
                    ['parent_type', 'page_avatar'],
                    ['parent_id', $id],
                ])->first();

                if ($image) {
                    Storage::deleteDirectory('public/upload/page_avatar/' . $id);
                    $image->update([
                        'image' => $request->file('image')->getClientOriginalName(),
                        'create_date' => Carbon::now()->toDateTimeString(),
                        'sort' => 0,
                        'parent_type' => 'page_avatar',
                        'parent_id' => $page->id,
                    ]);
                    Image::savePageAvatar($request->file('image'), $image->id, $page->id);
                } else {
                    $image = Image::create([
                        'image' => $request->file('image')->getClientOriginalName(),
                        'create_date' => Carbon::now()->toDateTimeString(),
                        'sort' => 0,
                        'parent_type' => 'page_avatar',
                        'parent_id' => $page->id,
                    ]);
                    Image::savePageAvatar($request->file('image'), $image->id, $page->id);
                }
            }
        }, 3);

        return redirect(route('admin.pages.index'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $page = Page::find($id);
            $image = Image::where([
                ['parent_type', 'page_avatar'],
                ['parent_id', $id],
            ])->first();
            $seo = SEO::find($page['seo_id']);

            $page->delete();
            if ($image) {
                $image->delete();
                Storage::deleteDirectory('public/upload/page_avatar/' . $id);
            }
            $seo->delete();
        }, 3);

        return redirect(route('admin.pages.index'));
    }
}