<?php

namespace App\Actions\PortfolioSection;

use App\Models\PortfolioSection;

class GetPortfolioSectionAction
{
    public function run($id)
    {
        return PortfolioSection::find($id);
    }
}
