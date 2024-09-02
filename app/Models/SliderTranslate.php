<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTranslate extends Model
{
    use HasFactory;

    protected $fillable = [
        "slider_id",
        "lang",
        "title",
        "description"
    ];

    public $timestamps = false;
}
