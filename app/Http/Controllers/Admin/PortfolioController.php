<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\BuildGalleryImagesPathsAction;
use App\Actions\Image\BuildPortfolioAvatarPathAction;
use App\Actions\Image\GetPortfolioAvatarAction;
use App\Actions\Image\GetPortfolioGalleryAction;
use App\Actions\Portfolio\GetPortfolioAction;
use App\Actions\Portfolio\GetPortfolioItemsAction;
use App\Actions\Portfolio\GetPortfolioSectionsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Portfolio; 
use App\Models\SEO;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolioItems = (new GetPortfolioItemsAction)->run();

        return view('admin.portfolio.index', compact('portfolioItems'));
    }

    public function create()
    {
        $sections = (new GetPortfolioSectionsAction)->run();

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
        $portfolio = (new GetPortfolioAction)->run($id);
        $sections = (new GetPortfolioSectionsAction)->run();
        $seo = (new GetSeoAction)->run($portfolio['seo_id']);
        $image = (new GetPortfolioAvatarAction)->run($id);
        $image_path = (new BuildPortfolioAvatarPathAction)->run($image);

        $gallery = (new GetPortfolioGalleryAction)->run($id);
        $gallery = (new BuildGalleryImagesPathsAction)->run($id, $gallery );

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

        $portfolio = (new GetPortfolioAction)->run($id);
        $seo = (new GetSeoAction)->run($portfolio['seo_id']);

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
            $portfolio = (new GetPortfolioAction)->run($id);
            $seo = (new GetSeoAction)->run($portfolio['seo_id']);

            $image = Image::where([
                ['parent_type', 'portfolio_avatar'],
                ['parent_id', $id],
            ])->first();

            $portfolio->delete();
            $seo->delete();

            if ($image) {
                $image->delete();
                Storage::deleteDirectory('public/upload/portfolio_avatar/' . $id);
            }
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }
}