<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslate extends Model
{
    protected $fillable = [
        'category_id',
        'lang',
        'title',
        'description'
    ];

    public $timestamps = false;
}
