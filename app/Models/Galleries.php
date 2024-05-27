<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galleries extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'id',
        'name',
        'create_date',
        'update_date',
        'user_id',
        'status',
    ];

    protected $casts = [];

    protected $dates = [
        'create_date',
        'update_date',
    ];

    public $timestamps = false;
}
