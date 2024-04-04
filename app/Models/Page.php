<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'page';

    protected $fillable = [
        'id',
        'name',
        'create_date',
        'update_date',
        'user_id',
        'url',
        'system',
        'h1',
        'text',
        'seo_id',
        'parent_id',
        'menu_sort',
        'menu_show',
        'status',
        'system_page',
        'portfolio_section_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'create_date',
        'update_date',
    ];

    public $timestamps = false;

    public static function getRules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'h1' => ['required', 'string', 'min:3', 'max:100'],
            'parent_id' => ['required', 'integer', 'min:0'],
            'text' => ['required', 'string', 'min:10'],
            'url' => ['required', 'min:3', 'max:50'],
            'menu_sort' => ['required', 'integer', 'min:0', 'max:100'],
            'menu_show' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
            'system_page' => ['required', 'in:0,1,2,3,4,5,6,7'],
        ];
    }

    public static function parents($url)
    {
        $page = Page::where('url', $url)->first();

        $parents = array();

        $current_id = $page['parent_id'];

        do {
            $parent = Page::where('id', $current_id)->first();
            array_unshift($parents, $parent);
            $current_id = $parent['parent_id'];

        } while ($current_id > 0);

        return $parents;
    }
}