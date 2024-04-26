<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ_Questions extends Model
{
    use HasFactory;

    protected $table = 'faq_question';

    protected $fillable = [
        'id',
        'name',
        'answer',
        'create_date',
        'update_date',
        'user_id',
        'faq_id',
        'file_id',
        'sort',
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
