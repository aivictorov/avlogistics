<?php

namespace App\Actions\Page;

use App\Actions\Page\CreatePageData;
use App\Models\Page;

class CreatePageAction
{
    public function run(CreatePageData $data)
    {
        return Page::create([
            'name' => $data->name,
            'h1' => $data->h1,
            'parent_id' => $data->parent_id,
            'text' => $data->text,
            'url' => $data->url,
            'menu_sort' => $data->menu_sort,
            'menu_show' => $data->menu_show,
            'status' => $data->status,
            'system_page' => $data->system_page,

            'seo_id' => $data->seo_id,
        ]);
    }
}
