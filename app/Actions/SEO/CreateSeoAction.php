<?php

namespace App\Actions\Seo;

use App\Actions\Seo\CreateSeoData;
use App\Models\Seo;

class CreateSeoAction
{
    public function run(CreateSeoData $data)
    {
        return Seo::create([
            'title' => $data->title,
            'description' => $data->description,
            'keywords' => $data->keywords,
        ]);
    }
}
