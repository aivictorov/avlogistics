<?php

namespace App\Actions\Page;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\UpdatePageData;

class UpdatePageAction
{
    public function run($page, UpdatePageData $data)
    {
        return $page->update([
            'name' => $data->name,
            'h1' => $data->h1,
            'parent_id' => $data->parent_id,
            'text' => $data->text,
            'url' => $data->url,
            'menu_sort' => $data->menu_sort,
            'menu_show' => $data->menu_show,
            'status' => $data->status,
            // 'system_page' => $data->system_page,
        ]);
    }
}
