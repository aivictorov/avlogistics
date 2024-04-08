<?php

namespace App\Actions\Page;

use App\Actions\Page\CreatePageData;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
            'system' => 0,
            'portfolio_section_id' => null,
        ]);
    }
}
