<?php

namespace App\Actions\Page;

use App\Models\Page;

class GetPageAction
{
    public function run($id)
    {
        return Page::find($id);
    }
}
