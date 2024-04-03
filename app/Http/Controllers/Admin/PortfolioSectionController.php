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
        $sections = PortfolioSection::select('id', 'name', 'update_date', 'status')->orderBy('id')->get()->toArray();

        return view('admin.portfolioSections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.portfolioSections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'sort_key' => ['required'],
        ]);

        $validated = array_merge($validated, [
            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => 1,
            'status' => 1,
        ]);

        $portfolioSection = PortfolioSection::create($validated);

        return redirect(route('admin.portfolioSections.index'));
    }

    public function edit($id)
    {
        $section = PortfolioSection::find($id);
        return view('admin.portfolioSections.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => ['required', 'string'],
            'sort_key' => ['required'],
            'status' => ['required'],
        ]);

        PortfolioSection::find($id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'sort_key' => $request->sort_key,
        ]);

        return redirect(route('admin.portfolioSections.index'));
    }

    public function destroy($id)
    {
        PortfolioSection::find($id)->delete();
        return redirect(route('admin.portfolioSections.index'));
    }
}
