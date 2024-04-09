<?php

namespace App\Actions\Portfolio;

use App\Models\PortfolioSection;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GetPortfolioSectionsAction
{
    public function run($sort = 'id')
    {
        $sections = PortfolioSection::select('id', 'name', 'update_date', 'status')->where('status', 1)->orderBy($sort)->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
            $sections[$key]['update_date'] = Carbon::parse($section['update_date'])->toDateString();
        }

        return $sections;
    }
}
