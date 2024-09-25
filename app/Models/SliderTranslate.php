<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslate extends Model
{
    protected $fillable = [
        "slider_id",
        "lang",
        "title",
        "description"
    ];

    public $timestamps = false;
}
