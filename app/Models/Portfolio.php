<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolio';

    protected $fillable = [
        'id',
        'name',
        'create_date',
        'update_date',
        'portfolio_section_id',
        'user_id',
        'h1',
        'url',
        'status',
        'text',
        'sort_key',
        'seo_id',
    ];

    protected $casts = [
        // 'status' => 'boolean',
    ];

    protected $dates = [
        'create_date',
        'update_date',
    ];

    public $timestamps = false;
}
