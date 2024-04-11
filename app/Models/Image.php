<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    protected $fillable = [
        'id',
        'image',
        'create_date',
        'sort',
        'parent_type',
        'parent_id',
    ];

    protected $casts = [];

    protected $dates = [
        'create_date',
    ];

    public $timestamps = false;

    public static function path($image)
    {
        if ($image) {
            if ($image->parent_type == 'page_avatar' || $image->parent_type == 'portfolio_avatar') {
                $prefix = 'page';
            } else if ($image->parent_type == 'portfolio_image') {
                $prefix = 'small';
            }

            return Storage::disk('public')->url('/upload/' . $image->parent_type . '/' . $image->parent_id . '/' . $image->id . '/sizes/' . $prefix . '_' . $image->image);

        } else {
            return '';
        }
    }
}
