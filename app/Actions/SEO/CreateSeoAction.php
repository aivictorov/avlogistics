<?php

namespace App\Actions\SEO;

use App\Actions\SEO\CreateSeoData;
use App\Models\SEO;

class CreateSeoAction
{
    public function run(CreateSeoData $data)
    {
        return SEO::create([
            'title' => $data->title,
            'description' => $data->description,
            'keywords' => $data->keywords,
        ]);
    }
}
