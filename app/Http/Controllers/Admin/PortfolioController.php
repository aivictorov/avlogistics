<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioSection;
use App\Models\SEO;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PortfolioController extends Controller
{
    public function index()
    {
        $portfolioItems = Portfolio::select('id', 'name', 'update_date', 'status')->orderBy('id')->get()->toArray();

        foreach ($portfolioItems as $key => $item) {
            $portfolioItems[$key]['update_date'] = Carbon::parse($item['update_date'])->toDateString();
        }

        return view('admin.portfolio.index', compact('portfolioItems'));
    }

    public function create()
    {
        $sections = PortfolioSection::select('id', 'name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        return view('admin.portfolio.create', compact('sections'));
    }

    public function store(Request $request)
    {
        if (!$request->filled('url')) {
            $request->merge([
                'url' => Str::slug($request->input('name')),
            ]);
        }

        $validated = $request->validate(array_merge(Portfolio::getRules(), SEO::getRules(), Image::getRules()));

        $validated = array_merge($validated, [
            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);

        DB::transaction(function () use ($validated, $request) {
            $seo = SEO::create($validated);
            $validated = array_merge($validated, ['seo_id' => $seo->id]);

            $portfolio = Portfolio::create($validated);

            if ($request->has('image')) {
                $image = Image::create([
                    'image' => $request->file('image')->getClientOriginalName(),
                    'create_date' => Carbon::now()->toDateTimeString(),
                    'sort' => 0,
                    'parent_type' => 'portfolio_avatar',
                    'parent_id' => $portfolio->id,
                ]);

                Image::savePortfolioAvatar($request->file('image'), $image->id, $portfolio->id);
            }
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }

    public function edit($id)
    {
        $portfolio = Portfolio::where('id', $id)->first();
        $sections = PortfolioSection::select('id', 'name', 'update_date', 'status')->orderBy('id')->get()->toArray();

        $image = Image::where([
            ['parent_type', 'portfolio_avatar'],
            ['parent_id', $id],
        ])->first();

        if ($image) {
            $image_path = '/storage/upload/portfolio_avatar/' . $id . '/' . $image['id'] . '/sizes/page_' . $image['image'];
        } else {
            $image_path = '';
        }

        $gallery = Image::where([
            ['parent_type', 'portfolio_image'],
            ['parent_id', $id],
        ])->get();

        if ($gallery) {
            foreach ($gallery as $key => $image) {
                $gallery[$key] = '/storage/upload/portfolio_image/' . $id . '/' . $image['id'] . '/sizes/small_' . $image['image'];
            }
        }

        $seo = SEO::find($portfolio['seo_id']);

        return view('admin.portfolio.edit', compact('portfolio', 'sections', 'image_path', 'gallery', 'seo'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->filled('url')) {
            $request->merge([
                'url' => Str::slug($request->input('name')),
            ]);
        }

        $validated = $request->validate(array_merge(Portfolio::getRules(), SEO::getRules(), Image::getRules()));

        $validated = array_merge($validated, [
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);

        $portfolio = Portfolio::find($id);
        $seo = SEO::find($portfolio['seo_id']);

        DB::transaction(function () use ($portfolio, $seo, $validated, $request, $id) {
            $portfolio->update($validated);
            $seo->update($validated);

            if ($request->has('image')) {
                $image = Image::where([
                    ['parent_type', 'portfolio_avatar'],
                    ['parent_id', $id],
                ])->first();

                if ($image) {
                    Storage::deleteDirectory('public/upload/portfolio_avatar/' . $id);

                    $image->update([
                        'image' => $request->file('image')->getClientOriginalName(),
                        'create_date' => Carbon::now()->toDateTimeString(),
                        'sort' => 0,
                        'parent_type' => 'portfolio_avatar',
                        'parent_id' => $portfolio->id,
                    ]);

                    Image::savePortfolioAvatar($request->file('image'), $image->id, $portfolio->id);

                } else {
                    $image = Image::create([
                        'image' => $request->file('image')->getClientOriginalName(),
                        'create_date' => Carbon::now()->toDateTimeString(),
                        'sort' => 0,
                        'parent_type' => 'portfolio_avatar',
                        'parent_id' => $portfolio->id,
                    ]);

                    Image::savePortfolioAvatar($request->file('image'), $image->id, $portfolio->id);
                }
            }
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $portfolio = Portfolio::find($id);
            $image = Image::where([
                ['parent_type', 'portfolio_avatar'],
                ['parent_id', $id],
            ])->first();
            $seo = SEO::find($portfolio['seo_id']);

            $portfolio->delete();
            if ($image) {
                $image->delete();
                Storage::deleteDirectory('public/upload/portfolio_avatar/' . $id);
            }
            $seo->delete();
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }
}