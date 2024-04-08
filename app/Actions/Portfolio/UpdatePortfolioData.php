<?php

namespace App\Actions\Portfolio;

class UpdatePortfolioData
{
    public function __construct(
        public $name,
        public $h1,
        public $portfolio_section_id,
        public $text,
        public $url,
        public $sort_key,
        public $status,
    ) {
        //
    }
}
