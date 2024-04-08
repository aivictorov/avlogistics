<?php

namespace App\Actions\SEO;

use App\Actions\SEO\CreateSeoData;
use App\Models\SEO;

class UpdateSeoAction
{
    public function run($seo, UpdateSeoData $data)
    {
        return $seo->update([
            'title' => $data->title,
            'description' => $data->description,
            'keywords' => $data->keywords,
        ]);
    }
}
