<?php

namespace App\Http\Controllers\Admin;

use App\Actions\FAQ\CreateFaqAction;
use App\Actions\FAQ\CreateFaqData;
use App\Actions\FAQ\CreateQuestionAction;
use App\Actions\FAQ\CreateQuestionData;
use App\Actions\FAQ\GetFaqAction;
use App\Actions\FAQ\GetFaqSectionsAction;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Page\CreatePageAction;
use App\Actions\Page\CreatePageData;
use App\Actions\SEO\CreateSeoAction;
use App\Actions\SEO\CreateSeoData;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Requests\FaqRequest;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validated();

        // dd($validated);

        DB::transaction(function () use ($validated) {

            $seo = (new CreateSeoAction)->run(
                new CreateSeoData(
                    title: $validated['title'],
                    description: $validated['description'],
                    keywords: $validated['keywords'],
                )
            );

            $faq = (new CreateFaqAction)->run(
                new CreateFaqData(
                    name: $validated['name'],
                    h1: $validated['h1'],
                    announce: $validated['announce'],
                    url: $validated['url'],
                    sort_key: $validated['sort_key'],
                    status: $validated['status'],
                    seo_id: $seo->id,
                )
            );

            foreach ($validated['questions'] as $key => $question) {
                $question = (new CreateQuestionAction)->run(
                    new CreateQuestionData(
                        name: $question['name'],
                        answer: $question['answer'],
                        faq_id: $faq->id,
                    )
                );
            };
        }, 3);
        return redirect(route('admin.faq.index'));
    }


    public function edit($id)
    {
        $faq_category = (new GetFaqAction)->run($id);
        $seo = (new GetSeoAction)->run($faq_category['seo_id']);
        return view('admin.faq.edit', compact('faq_category', 'seo'));
    }
}
