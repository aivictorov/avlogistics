<?php

namespace App\Actions\Portfolio;

use App\Models\PortfolioSection;
use Illuminate\Support\Str;

class GetPortfolioSectionsAction
{
    public function run()
    {
        $sections = PortfolioSection::select('id', 'name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
        }

        return $sections;
    }
}
