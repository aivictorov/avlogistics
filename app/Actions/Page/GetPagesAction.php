<?php

namespace App\Actions\Page;

use App\Models\Page;
use Carbon\Carbon;

class GetPagesAction
{
    public function run()
    {
        $pages = Page::select('id', 'name', 'url', 'update_date', 'status')->orderBy('id')->get()->toArray();

        foreach ($pages as $key => $page) {
            $pages[$key]['update_date'] = Carbon::parse($page['update_date'])->toDateString();
        }
        
        return $pages;
    }
}
