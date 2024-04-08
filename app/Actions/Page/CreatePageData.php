<?php

namespace App\Actions\Page;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreatePageData
{
    public function __construct(
        public $name,
        public $h1,
        public $parent_id,
        public $text,
        public $url,
        public $menu_sort,
        public $menu_show,
        public $status,
        public $system_page,

        public $seo_id,
    ) {
        $this->create_date = Carbon::now()->toDateTimeString();
        $this->update_date = Carbon::now()->toDateTimeString();
        $this->user_id = Auth::user()->id;
        $this->system = 0;
        $this->portfolio_section_id = null;
    }
}