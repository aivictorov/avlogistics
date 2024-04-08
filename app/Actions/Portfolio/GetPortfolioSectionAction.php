<?php

namespace App\Actions\Portfolio;

use App\Models\PortfolioSection;

class GetPortfolioSectionAction
{
    public function run($id)
    {
        return PortfolioSection::find($id);
    }
}
