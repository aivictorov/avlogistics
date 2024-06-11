<?php

namespace App\Actions\Seo;

use App\Actions\Seo\CreateSeoData;
use App\Models\Seo;

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
