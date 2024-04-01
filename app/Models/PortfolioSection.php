<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioSection extends Model
{
    use HasFactory;

    protected $table = 'portfolio_section';

    protected $fillable = [
        'id',
        'name',
        'create_date',
        'update_date',
        'user_id',
        'status',
        'sort_key',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'create_date',
        'update_date',
    ];

    public $timestamps = false;
}
