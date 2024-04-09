<?php

namespace App\Http\Controllers;

use App\Actions\FAQ\GetFaqAction;
use App\Actions\FAQ\GetFaqIdByUrlAction;
use App\Actions\FAQ\GetFaqParentsAction;
use App\Actions\FAQ\GetFaqSectionsAction;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIdByUrlAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\Questions\GetQuestionsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Models\FAQ_Questions;
use Illuminate\Support\Str;

class FAQController extends Controller
{
    public function index()
    {
        $id = (new GetPageIdByUrlAction)->run('faq');
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $parents = (new GetPageParentsAction)->run($id);

        $faq_categories = (new GetFaqSectionsAction)->run();

        foreach ($faq_categories as $key => $category) {
            $faq_categories[$key]['items'] = FAQ_Questions::select('name', 'answer')->where('faq_id', $category['id'])->orderBy('sort')->get()->toArray();

            foreach ($faq_categories[$key]['items'] as $key2 => $item) {
                $faq_categories[$key]['items'][$key2]['url'] = Str::slug($item['name']);
            }
        }

        return view('faq.index', compact('page', 'parents', 'seo', 'faq_categories'));
    }

    public function show($url)
    {
        $id = (new GetFaqIdByUrlAction)->run($url);
        $page = (new GetFaqAction)->run($id);
        $parents = (new GetFaqParentsAction)->run();
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $faq_categories = (new GetFaqSectionsAction)->run();
        $faq_questions = (new GetQuestionsAction)->run($id);

        return view('faq.show', compact('page', 'parents', 'seo', 'faq_questions', 'faq_categories'));
    }
}
