<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Categories;

class GetFaqAction
{
    public function run($id)
    {
        return FAQ_Categories::find($id);
    }
}