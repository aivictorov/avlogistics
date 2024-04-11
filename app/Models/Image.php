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

    public static function path($image, $prefix = "page")
    {
        if ($image) {
            return Storage::disk('public')->url('/upload/' . $image->parent_type . '/' . $image->parent_id . '/' . $image->id . '/sizes/' . $prefix . '_' . $image->image);

        } else {
            return '';
        }
    }
}
