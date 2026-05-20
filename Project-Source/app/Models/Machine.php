<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'title',
        'category',
        'brand',
        'condition',
        'year',
        'material',
        'stock_status',
        'short_description',
        'description',
        'extra_info',
        'is_active',
    ];
}