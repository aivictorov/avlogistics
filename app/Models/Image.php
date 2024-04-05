<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;

InterventionImage::configure(['driver' => 'imagick']);

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

    public static function getRules(): array
    {
        return [
            'image' => ['nullable', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=270',],
        ];
    }

    public static function savePageAvatar($file, $image_id, $page_id)
    {
        $image = InterventionImage::make($file);

        Storage::makeDirectory('public/upload/page_avatar/' . $page_id . '/' . $image_id . '/original');
        $original_image_path = storage_path('app/public/upload/page_avatar/' . $page_id . '/' . $image_id . '/original/' . $file->getClientOriginalName());
        $image->save($original_image_path);

        $image->fit(670, 270);

        $watermark = InterventionImage::make(public_path('images/watermark.png'));
        $image->insert($watermark, 'center');

        $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
        $image->insert($mini_watermark, 'bottom-right');

        Storage::makeDirectory('public/upload/page_avatar/' . $page_id . '/' . $image_id . '/sizes');
        $page_image_path = storage_path('app/public/upload/page_avatar/' . $page_id . '/' . $image_id . '/sizes/' . 'page_' . $file->getClientOriginalName());
        $image->save($page_image_path);

        return;
    }

    public static function savePortfolioAvatar($file, $image_id, $page_id)
    {
        $image = InterventionImage::make($file);

        Storage::makeDirectory('public/upload/portfolio_avatar/' . $page_id . '/' . $image_id . '/original');
        $original_image_path = storage_path('app/public/upload/portfolio_avatar/' . $page_id . '/' . $image_id . '/original/' . $file->getClientOriginalName());
        $image->save($original_image_path);

        $image->fit(670, 270);

        $watermark = InterventionImage::make(public_path('images/watermark.png'));
        $image->insert($watermark, 'center');

        $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
        $image->insert($mini_watermark, 'bottom-right');

        Storage::makeDirectory('public/upload/portfolio_avatar/' . $page_id . '/' . $image_id . '/sizes');
        $page_image_path = storage_path('app/public/upload/portfolio_avatar/' . $page_id . '/' . $image_id . '/sizes/' . 'page_' . $file->getClientOriginalName());
        $image->save($page_image_path);

        return;
    }

    public static function image($page_id)
    {
        $image = Image::where([['parent_id', $page_id], ['parent_type', 'page_avatar']])->first();

        if ($image) {
            $image_path = "\\storage\\upload\\" . $image->parent_type . "\\" . $image->parent_id . "\\" . $image->id . "\\sizes\\page_" . $image->image;
        } else {
            $image_path = "";
        }

        return $image_path;
    }

    public static function portfolio_image_path($page_id)
    {
        $image = Image::where([['parent_id', $page_id], ['parent_type', 'portfolio_avatar']])->first();

        if ($image) {
            $image_path = "\\storage\\upload\\" . $image->parent_type . "\\" . $image->parent_id . "\\" . $image->id . "\\sizes\\page_" . $image->image;
        } else {
            $image_path = "";
        }

        return $image_path;
    }
}
