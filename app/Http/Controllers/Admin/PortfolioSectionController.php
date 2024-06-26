<?php

namespace App\Http\Controllers\Admin;

use App\Actions\PortfolioSection\GetPortfolioSectionAction;
use App\Actions\PortfolioSection\GetPortfolioSectionsAction;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioSection;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PortfolioSectionController extends Controller
{
    public function index(SearchRequest $request)
    {
        if ($search = $request->validated('search')) {
            $sections = PortfolioSection::where('name', 'like', '%' . $search . '%')->paginate(15);
            $sections->appends(['search' => $search]);
        } else {
            $sections = PortfolioSection::paginate(15);
        }

        // $sections = (new GetPortfolioSectionsAction)->run();
        return view('admin.pages.portfolioSections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.pages.portfolioSections.create');
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
        $section = (new GetPortfolioSectionAction)->run($id);

        return view('admin.pages.portfolioSections.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(PortfolioSection::getRules());

        $validated = array_merge($validated, [
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);

        $section = (new GetPortfolioSectionAction)->run($id);
        $section->update($validated);

        return redirect(route('admin.portfolioSections.index'));
    }

    public function destroy($id)
    {
        if (Portfolio::where('portfolio_section_id', $id)->count() > 0) {
            Session::flash('danger', 'Нельзя удалить категорию, в которой есть элементы.');
            return redirect()->back();
        } else {
            $section = (new GetPortfolioSectionAction)->run($id);
            $section->delete();
            return redirect(route('admin.portfolioSections.index'));
        }
    }

    public function publish($id, Request $request)
    {
        $status = $request->get('published');

        PortfolioSection::find($id)->update([
            'status' => $status,
            'update_date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back();
    }
}
