<?php

namespace App\Http\Controllers\Admin;

use App\Actions\FAQ\GetFaqAction;
use App\Actions\FAQ\GetFaqSectionsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Requests\FaqRequest;

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

    public function store(FaqRequest $request)
    {
        dd($request);

        return redirect(route('admin.faq.index'));
    }

    public function edit($id)
    {
        $faq_category = (new GetFaqAction)->run($id);
        $seo = (new GetSeoAction)->run($faq_category['seo_id']);
        return view('admin.faq.edit', compact('faq_category', 'seo'));
    }
}
