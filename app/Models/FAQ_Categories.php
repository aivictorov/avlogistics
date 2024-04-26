<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ_Categories extends Model
{
    use HasFactory;

    protected $table = 'faq';

    protected $fillable = [
        'id',
        'name',
        'create_date',
        'update_date',
        'user_id',
        'url',
        'h1',
        'announce',
        'seo_id',
        'status',
        'sort_key',
    ];

    protected $casts = [
        //
    ];

    protected $dates = [
        'create_date',
        'update_date',
    ];

    public $timestamps = false;
}
