<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Categories;

class GetFaqSectionsAction
{
    public function run()
    {
        return FAQ_Categories::select('id', 'name', 'url', 'h1', 'announce')
            ->where('status', 1)
            ->orderBy('sort_key')
            ->get()
            ->toArray();
    }
}
