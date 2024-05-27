<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItems extends Model
{
    use HasFactory;

    protected $table = 'gallery_item';

    protected $fillable = [
        'id',
        'gallery_id',
        'text',
        'portfolio_id',
        'create_date',
        'update_date',
        'user_id',
        'sort',
    ];

    protected $casts = [];

    protected $dates = [
        'create_date',
        'update_date',
    ];

    public $timestamps = false;
}
