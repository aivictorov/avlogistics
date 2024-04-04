<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Portfolio;
use App\Models\Image;
use App\Models\PortfolioSection;
use App\Models\SEO;

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
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'h1' => ['required', 'string'],
            'url' => ['required', 'string'],
            "text" => [],
            'sort_key' => ['required'],
        ]);

        $validated = array_merge($validated, [
            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'portfolio_section_id' => 1,
            'user_id' => 1,
            'status' => 1,
            'seo_id' => 1,
        ]);

        $portfolio = Portfolio::create($validated);

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
        return 'update';

        // $validated = $request->validate([
        //     'name' => ['required', 'string'],
        //     'sort_key' => ['required'],
        //     'status' => ['required'],
        // ]);

        // Portfolio::find($id)->update([
        //     'name' => $request->name,
        //     'status' => $request->status,
        //     'sort_key' => $request->sort_key,
        // ]);

        // return redirect(route('admin.portfolio.index'));
    }

    public function destroy($id)
    {
        Portfolio::find($id)->delete();
        return redirect(route('admin.portfolio.index'));
    }
}
