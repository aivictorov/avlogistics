<?php

namespace App\Http\Controllers\Admin;

use App\Actions\FAQ\GetFaqAction;
use App\Actions\FAQ\GetFaqSectionsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Models\FAQ_Categories;
use App\Models\SEO;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faq_categories = (new GetFaqSectionsAction)->run();

        return view('admin.faq.index', compact('faq_categories'));
    }

    public function create()
    {
        $sections = (new GetFaqSectionsAction)->run();

        return view('admin.faq.create', compact('sections'));
    }

    public function store(Request $request)
    {
        dd($request);

        // $validated = $request->validate([
        //     'name' => ['required', 'string'],
        //     'h1' => ['required', 'string'],
        //     'url' => ['required', 'string'],
        //     "text" => [],
        //     'sort_key' => ['required'],
        // ]);

        // $validated = array_merge($validated, [
        //     'create_date' => Carbon::now()->toDateTimeString(),
        //     'update_date' => Carbon::now()->toDateTimeString(),
        //     'portfolio_section_id' => 1,
        //     'user_id' => 1,
        //     'status' => 1,
        //     'seo_id' => 1,
        // ]);

        // $faq = FAQ_Questions::create($validated);

        return redirect(route('admin.faq.index'));
    }

    public function edit($id)
    {
        $faq_category = (new GetFaqAction)->run($id);
        $seo = (new GetSeoAction)->run($faq_category['seo_id']);
        return view('admin.faq.edit', compact('faq_category', 'seo'));
    }
}
