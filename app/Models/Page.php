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
        'create_date', 'update_date',
        'user_id',
        'url',
        'system',
        'h1', 'text',
        'seo_id',
        'parent_id',
        'menu_sort', 'menu_show',
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
}
