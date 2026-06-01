<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralOption extends Model
{
    protected $fillable = [

        'option_name',
        'title',
        'value',
        'description',
        'lbl_text',
        'icon_image',
        'is_active',
        'is_excluded',
        'is_default',

    ];
}