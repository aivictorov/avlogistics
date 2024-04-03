<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Models\Portfolio;
use App\Models\PortfolioSection;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolioItems = Portfolio::select('id', 'name', 'update_date', 'status')->orderBy('id')->get()->toArray();

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
        return view('admin.portfolio.edit', compact('portfolio', 'sections'));
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
