<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuTranslate extends Model
{

    protected $fillable = [
        "menu_id",
        "lang",
        "title",
    ];

    public $timestamps = false;
}
