<?php

namespace App\Actions\Portfolio;

use App\Models\PortfolioSection;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GetPortfolioSectionsAction
{
    public function run()
    {
        $sections = PortfolioSection::select('id', 'name', 'update_date', 'status')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
            $sections[$key]['update_date'] = Carbon::parse($section['update_date'])->toDateString();
        }

        return $sections;
    }
}
