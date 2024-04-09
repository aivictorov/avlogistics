<?php

namespace App\Actions\PortfolioSection;

use App\Models\PortfolioSection;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GetPortfolioSectionsAction
{
    public function run($sort = 'id', $active = false)
    {
        if ($active) {
            $sections = PortfolioSection::select('id', 'name', 'update_date', 'status')->where('status', 1)->orderBy($sort)->get()->toArray();
        } else {
            $sections = PortfolioSection::select('id', 'name', 'update_date', 'status')->orderBy($sort)->get()->toArray();
        }

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
            $sections[$key]['update_date'] = Carbon::parse($section['update_date'])->toDateString();
        }

        return $sections;
    }
}
