<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PortfolioSection;
use Illuminate\Support\Facades\Auth;

class PortfolioSectionController extends Controller
{
    public function index()
    {
        $sections = PortfolioSection::select('id', 'name', 'update_date', 'status')->orderBy('id')->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['update_date'] = Carbon::parse($section['update_date'])->toDateString();
        }

        return view('admin.portfolioSections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.portfolioSections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(PortfolioSection::getRules());

        $validated = array_merge($validated, [
            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);

        PortfolioSection::create($validated);

        return redirect(route('admin.portfolioSections.index'));
    }

    public function edit($id)
    {
        $section = PortfolioSection::find($id);

        return view('admin.portfolioSections.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(PortfolioSection::getRules());

        PortfolioSection::find($id)->update($validated);

        return redirect(route('admin.portfolioSections.index'));
    }

    public function destroy($id)
    {
        PortfolioSection::find($id)->delete();
        
        return redirect(route('admin.portfolioSections.index'));
    }
}
