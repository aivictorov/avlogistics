<?php

namespace App\Actions\Page;

use App\Models\Page;
use Carbon\Carbon;

class GetPagesAction
{
    public function run($sort = 'id')
    {
        $pages = Page::select('id', 'name', 'url', 'create_date', 'update_date', 'status', 'system_page')
            ->get()
            ->sortBy($sort)
            ->toArray();

        foreach ($pages as $key => $page) {
            $pages[$key]['create_date'] = Carbon::parse($page['create_date'])->toDateString();
            $pages[$key]['update_date'] = Carbon::parse($page['update_date'])->toDateString();
        }

        return $pages;
    }
}
