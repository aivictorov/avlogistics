<?php

namespace App\Actions\Page;

use App\Models\Page;

class GetPageParentsAction
{
    public static function run($id)
    {
        $page = (new GetPageAction)->run($id);

        $parents = array();
        $current_id = $page['parent_id'];

        do {
            $parent = Page::where('id', $current_id)->first();
            array_unshift($parents, $parent);
            $current_id = $parent['parent_id'];

        } while ($current_id > 0);

        return $parents;
    }
}
