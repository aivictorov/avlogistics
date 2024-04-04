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

    public static function getRules(): array
    {
        return [
            'title' => ['nullable', 'string', 'min:3', 'max:100'],
            'description' => ['nullable', 'string', 'min:3', 'max:250'],
            'keywords' => ['nullable', 'string', 'min:3', 'max:250'],
        ];
    }
}
