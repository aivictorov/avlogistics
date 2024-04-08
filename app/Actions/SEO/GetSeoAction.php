<?php

namespace App\Actions\SEO;

use App\Models\SEO;

class GetSeoAction
{
    public function run($id)
    {
        return SEO::find($id);
    }
}
