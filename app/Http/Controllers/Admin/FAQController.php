<?php

namespace App\Http\Controllers\Admin;

use App\Actions\FAQ\CreateFaqAction;
use App\Actions\FAQ\CreateFaqData;
use App\Actions\FAQ\GetFaqAction;
use App\Actions\FAQ\GetFaqSectionsAction;
use App\Actions\FAQ\UpdateFaqAction;
use App\Actions\FAQ\UpdateFaqData;
use App\Actions\Questions\CreateQuestionAction;
use App\Actions\Questions\CreateQuestionData;
use App\Actions\Questions\GetQuestionsAction;
use App\Actions\Questions\UpdateQuestionAction;
use App\Actions\Questions\UpdateQuestionData;
use App\Actions\SEO\CreateSeoAction;
use App\Actions\SEO\CreateSeoData;
use App\Actions\SEO\GetSeoAction;
use App\Actions\SEO\UpdateSeoAction;
use App\Actions\SEO\UpdateSeoData;
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
                        sort: $question['sort'],
                        faq_id: $faq->id,
                    )
                );
            };
        }, 3);
        return redirect(route('admin.faq.index'));
    }

    public function edit($id)
    {
        $faq = (new GetFaqAction)->run($id);
        $seo = (new GetSeoAction)->run($faq['seo_id']);
        $questions = (new GetQuestionsAction)->run($id);

        return view('admin.faq.edit', compact('faq', 'seo', 'questions'));
    }

    public function update(FaqRequest $request, $id)
    {
        $faq = (new GetFaqAction)->run($id);
        $seo = (new GetSeoAction)->run($faq['seo_id']);

        $questions = (new GetQuestionsAction)->run($id);

        foreach ($questions as $key => $question) {
            unset($questions[$key]['url']);
        }

        $validated = $request->validated();

        DB::transaction(function () use ($faq, $seo, $validated, $questions) {

            (new UpdateFaqAction)->run(
                $faq,
                new UpdateFaqData(
                    name: $validated['name'],
                    h1: $validated['h1'],
                    announce: $validated['announce'],
                    url: $validated['url'],
                    sort_key: $validated['sort_key'],
                    status: $validated['status'],
                )
            );

            (new UpdateSeoAction)->run(
                $seo,
                new UpdateSeoData(
                    title: $validated['title'],
                    description: $validated['description'],
                    keywords: $validated['keywords'],
                )
            );

            foreach ($questions as $question) {
                $question = (new UpdateQuestionAction)->run(
                    $question,
                    new UpdateQuestionData(
                        name: $question['name'],
                        answer: $question['answer'],
                        sort: $question['sort'],
                    )
                );
            };
        }, 3);

        return redirect(route('admin.faq.index'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $faq = (new GetFaqAction)->run($id);
            $seo = (new GetSeoAction)->run($faq['seo_id']);
            $questions = (new GetQuestionsAction)->run($id);

            $faq->delete();
            $seo->delete();
            foreach ($questions as $key => $question) {
                $question->delete();
            }
        }, 3);

        return redirect(route('admin.faq.index'));
    }
}
