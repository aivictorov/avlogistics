<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Faq\CreateFaqAction;
use App\Actions\Faq\CreateFaqData;
use App\Actions\Faq\GetFaqAction;
use App\Actions\Faq\GetFaqSectionsAction;
use App\Actions\Faq\UpdateFaqAction;
use App\Actions\Faq\UpdateFaqData;
use App\Actions\Question\CreateQuestionAction;
use App\Actions\Question\CreateQuestionData;
use App\Actions\Question\GetQuestionsAction;
use App\Actions\Question\UpdateQuestionAction;
use App\Actions\Question\UpdateQuestionData;
use App\Actions\Seo\CreateSeoAction;
use App\Actions\Seo\CreateSeoData;
use App\Actions\Seo\GetSeoAction;
use App\Actions\Seo\UpdateSeoAction;
use App\Actions\Seo\UpdateSeoData;
use App\Http\Controllers\Controller;
use App\Models\FaqCategories;
use App\Models\FaqQuestions;
use App\Http\Requests\FaqCreateRequest;
use App\Http\Requests\FaqEditRequest;
use App\Http\Requests\SearchRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index(SearchRequest $request)
    {
        if ($search = $request->validated('search')) {
            $faq_categories = FaqCategories::where('name', 'like', '%' . $search . '%')->paginate(15);
            $faq_categories->appends(['search' => $search]);
        } else {
            $faq_categories = FaqCategories::paginate(15);
        }

        // $faq_categories = (new GetFaqSectionsAction)->run();
        return view('admin.pages.faq.index', compact('faq_categories'));
    }

    public function create()
    {
        $sections = (new GetFaqSectionsAction)->run();
        return view('admin.pages.faq.create', compact('sections'));
    }

    public function store(FaqCreateRequest $request)
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

            // foreach ($validated['questions'] as $key => $question) {
            //     $question = (new CreateQuestionAction)->run(
            //         new CreateQuestionData(
            //             name: $question['name'],
            //             answer: $question['answer'],
            //             sort: $question['sort'],
            //             faq_id: $faq->id,
            //         )
            //     );
            // };
        }, 3);
        return redirect(route('admin.faq.index'));
    }

    public function edit($id)
    {
        $faq = (new GetFaqAction)->run($id);
        $seo = (new GetSeoAction)->run($faq['seo_id']);
        $questions = (new GetQuestionsAction)->run($id);

        return view('admin.pages.faq.edit', compact('faq', 'seo', 'questions'));
    }

    public function update(FaqEditRequest $request, $id)
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
                if (isset($validated['questions'][$question->id])) {
                    (new UpdateQuestionAction)->run(
                        $question,
                        new UpdateQuestionData(
                            name: $validated['questions'][$question->id]['name'],
                            answer: $validated['questions'][$question->id]['answer'],
                            sort: $validated['questions'][$question->id]['sort'],
                        )
                    );
                } else {
                    $question->delete();
                };
            };

            foreach ($validated['questions'] as $key => $question) {
                if (!FaqQuestions::Find($key)) {
                    (new CreateQuestionAction)->run(
                        new CreateQuestionData(
                            name: $question['name'],
                            answer: $question['answer'],
                            sort: $question['sort'],
                            faq_id: $faq->id,
                        )
                    );
                }
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

    public function publish($id, Request $request)
    {
        $status = $request->get('published');

        FaqCategories::find($id)->update([
            'status' => $status,
            'update_date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back();
    }
}
