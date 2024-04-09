<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Categories;
use Carbon\Carbon;

class GetFaqSectionsAction
{
    public function run($sort = 'id')
    {
        $faq_categories = FAQ_Categories::select('id', 'name', 'url', 'h1', 'announce', 'update_date', 'status')
            // ->where('status', 1)
            ->orderBy($sort)
            ->get()
            ->toArray();

        foreach ($faq_categories as $key => $category) {
            $faq_categories[$key]['update_date'] = Carbon::parse($category['update_date'])->toDateString();
        }

        return $faq_categories;
    }
}