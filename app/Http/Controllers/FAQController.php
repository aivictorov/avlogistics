<?php

namespace App\Http\Controllers;

use App\Actions\Faq\GetFaqAction;
use App\Actions\Faq\GetFaqIDAction;
use App\Actions\Faq\GetFaqParentsAction;
use App\Actions\Faq\GetFaqSectionsAction;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\Question\GetQuestionsAction;
use App\Actions\Seo\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Models\FaqQuestions;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index()
    {
        $id = (new GetPageIDAction)->run('faq');
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $parents = (new GetPageParentsAction)->run($id);
        $faq_categories = (new GetFaqSectionsAction)->run(sort: 'sort_key', active: true);

        foreach ($faq_categories as $key => $category) {
            $faq_categories[$key]['items'] = FaqQuestions::select('name', 'answer')->where('faq_id', $category['id'])->orderBy('sort')->get();

            foreach ($faq_categories[$key]['items'] as $key2 => $item) {
                $faq_categories[$key]['items'][$key2]['url'] = Str::slug($item['name']);
            }
        }

        return view('site.pages.faq.index', compact('page', 'parents', 'seo', 'faq_categories'));
    }

    public function show($url)
    {
        $id = (new GetFaqIDAction)->run($url);

        if ($id) {
            $page = (new GetFaqAction)->run($id);
            $parents = (new GetFaqParentsAction)->run();
            $seo = (new GetSeoAction)->run($page['seo_id']);
            $faq_categories = (new GetFaqSectionsAction)->run(sort: 'sort_key', active: true);

            foreach ($faq_categories as $key => $category) {
                $faq_categories[$key]['items'] = FaqQuestions::select('name', 'answer')->where('faq_id', $category['id'])->orderBy('sort')->get();

                foreach ($faq_categories[$key]['items'] as $key2 => $item) {
                    $faq_categories[$key]['items'][$key2]['url'] = Str::slug($item['name']);
                }
            }

            $announce = $faq_categories[$id]['announce'];

            $faq_questions = (new GetQuestionsAction)->run($id);

            return view('site.pages.faq.show', compact('page', 'parents', 'seo', 'faq_questions', 'faq_categories', 'announce'));
        } else {
            return view('site.404');
        }
    }
}