<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslate extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "lang",
        "title",
        "description",
        "features",
    ];

    public $timestamps = false;
}
