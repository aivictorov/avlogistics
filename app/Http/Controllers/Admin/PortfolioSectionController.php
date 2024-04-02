<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PortfolioSection;

class PortfolioSectionController extends Controller
{
    public function index()
    {
        $sections = PortfolioSection::select('id', 'name')->where('status', 1)->orderBy('id')->get()->toArray();

        return view('admin.portfolioSections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.portfolioSections.create');
    }

    public function store(Request $request)
    {
        $validatedPortfolioSection = $request->validate([
            'name' => ['required', 'string'],
            'sort_key' => ['required'],
        ]);

        $validatedPortfolioSection = array_merge($validatedPortfolioSection, [
            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => 1,
            'status' => 1,
        ]);

        $portfolioSection = PortfolioSection::create($validatedPortfolioSection);

        return redirect(route('admin.portfolioSections.index'));
    }
}
