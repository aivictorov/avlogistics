<?php

namespace App\Actions\FAQ;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Models\Page;

class GetFaqParentsAction
{
    public static function run()
    {
        $id = (new GetPageIDAction)->run('portfolio');
        $page = (new GetPageAction)->run($id);

        $parents = array();
        $current_id = $page['parent_id'];

        do {
            $parent = Page::where('id', $current_id)->first();
            array_unshift($parents, $parent);
            $current_id = $parent['parent_id'];

        } while ($current_id > 0);

        array_push($parents, Page::where('url', 'faq')->first());

        return $parents;
    }
}
