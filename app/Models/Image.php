<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function image($page_id)
    {
        $image = Image::where([['parent_id', $page_id], ['parent_type', 'page_avatar']])->first();

        if ($image) {
            $image_path = "\\upload\\" . $image->parent_type . "\\" . $image->parent_id . "\\" . $image->id . "\\sizes\\page_" . $image->image;
        } else {
            $image_path = "";
        }

        return $image_path;
    }
}
