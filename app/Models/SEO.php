<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    use HasFactory;
    
    protected $table = 'SEO';

    protected $fillable = [
        'id',
        'title',
        'description',
        'keywords',
    ];

    protected $casts = [
    ];

    protected $dates = [
    ];

    public $timestamps = false;
}
