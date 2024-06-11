<?php

namespace App\Actions\Seo;

use App\Models\Seo;

class GetSeoAction
{
    public function run($id)
    {
        return Seo::find($id);
    }
}
