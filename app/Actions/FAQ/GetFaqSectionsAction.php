<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Categories;
use Carbon\Carbon;

class GetFaqSectionsAction
{
    public function run($sort = 'id', $active = false)
    {
        if ($active) {
            $faq_categories = FAQ_Categories::select('id', 'name', 'url', 'h1', 'announce', 'update_date', 'status')
                ->where('status', 1)
                ->orderBy($sort)
                ->get();
        } else {
            $faq_categories = FAQ_Categories::select('id', 'name', 'url', 'h1', 'announce', 'update_date', 'status')
                // ->where('status', 1)
                ->orderBy($sort)
                ->get();
        }

        return $faq_categories;
    }
}