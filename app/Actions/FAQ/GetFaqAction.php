<?php

namespace App\Actions\Faq;

use App\Models\FaqCategories;

class GetFaqAction
{
    public function run($id)
    {
        return FaqCategories::find($id);
    }
}