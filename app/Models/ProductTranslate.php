<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslate extends Model
{
    protected $fillable = [
        "product_id",
        "lang",
        "title",
        "description",
        "features",
    ];

    public $timestamps = false;
}
