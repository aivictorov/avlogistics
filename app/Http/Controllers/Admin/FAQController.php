<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ_Questions;
use App\Models\FAQ_Categories;
use Illuminate\Support\Carbon;
use App\Models\SEO;

class FAQController extends Controller
{
    public function index()
    {
        $faq_categories = FAQ_Categories::select('id', 'name', 'update_date', 'status')->orderBy('id')->get()->toArray();

        foreach ($faq_categories as $key => $category) {
            $faq_categories[$key]['update_date'] = Carbon::parse($category['update_date'])->toDateString();
        }

        return view('admin.faq.index', compact('faq_categories'));
    }

    public function create()
    {
        // $sections = FAQ_Questions::select('id', 'name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        return view('admin.faq.create');
        // return view('admin.faq.create', compact('sections'));
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
        $faq_category = FAQ_Categories::find($id);

        $seo = SEO::find($faq_category['seo_id']);

        return view('admin.faq.edit', compact('faq_category', 'seo'));
    }
}
