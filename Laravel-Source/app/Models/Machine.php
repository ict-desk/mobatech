<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        //text
        'title',
        'product_code',
        'short_description',
        'description',
        'extra_info',
        'image',
        //combobox string
        'brand',
        'category',
        'condition',
        'material',
        'year',
        //combobox string
        'stock_status',
        //boolean
        'is_active',
        'is_featured',
    ];
}
