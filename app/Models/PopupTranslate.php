<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupTranslate extends Model
{
    protected $fillable = [
        "popup_id",
        "lang",
        "title",
        "description"
    ];

    public $timestamps = false;
}
