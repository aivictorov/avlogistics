<?php

namespace App\Http\Controllers;

use App\Actions\Image\GetImageAction;
use App\Actions\Image\GetImagesAction;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\Portfolio\GetPortfolioAction;
use App\Actions\Portfolio\GetPortfolioIDAction;
use App\Actions\Portfolio\GetPortfolioParentsAction;
use App\Actions\PortfolioSection\GetPortfolioSectionsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $id = (new GetPageIDAction)->run('portfolio');

        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $parents = (new GetPageParentsAction)->run($id);
        $sections = (new GetPortfolioSectionsAction)->run(sort: 'sort_key', active: true);

        foreach ($sections as $key => $section) {
            $sections[$key]['items'] = Portfolio::where('portfolio_section_id', $section['id'])->orderBy('sort_key')->get(['id', 'name', 'url'])->toArray();
            foreach ($sections[$key]['items'] as $key2 => $item) {
                $sections[$key]['items'][$key2]['image'] = Image::where([
                    ['parent_type', 'portfolio_avatar'],
                    ['parent_id', $sections[$key]['items'][$key2]['id']],
                ])->first(['id', 'image'])->toArray();
            }
        }

        // dd(count($sections[3]['items']));

        return view('portfolio.index', compact('page', 'parents', 'sections', 'seo'));
    }

    public function show($url)
    {
        $id = (new GetPortfolioIDAction)->run($url);

        if ($id) {
            $page = (new GetPortfolioAction)->run($id);
            $parents = (new GetPortfolioParentsAction)->run();
            $seo = (new GetSeoAction)->run($page['seo_id']);
            $sections = (new GetPortfolioSectionsAction)->run(sort: 'sort_key', active: true);
            $avatar = (new GetImageAction)->run($id, parent_type: 'portfolio_avatar');
            $images = (new GetImagesAction)->run($id, parent_type: 'portfolio_image');

            return view('portfolio.show', compact('page', 'parents', 'seo', 'sections', 'avatar', 'images'));
        } else {
            return view('site.404');
        }
    }
}