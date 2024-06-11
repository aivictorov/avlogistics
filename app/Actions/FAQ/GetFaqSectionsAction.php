<?php

namespace App\Actions\Faq;

use App\Models\FaqCategories;
use Carbon\Carbon;

class GetFaqSectionsAction
{
    public function run($sort = 'id', $active = false)
    {
        if ($active) {
            $faq_categories = FaqCategories::select('id', 'name', 'url', 'h1', 'announce', 'create_date', 'update_date', 'status')
                ->where('status', 1)
                ->orderBy($sort)
                ->get();
        } else {
            $faq_categories = FaqCategories::select('id', 'name', 'url', 'h1', 'announce', 'create_date', 'update_date', 'status')
                ->orderBy($sort)
                ->get();
        }

        return $faq_categories;
    }
}