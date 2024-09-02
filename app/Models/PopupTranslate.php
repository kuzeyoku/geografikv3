<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupTranslate extends Model
{
    use HasFactory;

    protected $fillable = [
        "popup_id",
        "lang",
        "title",
        "description"
    ];

    public $timestamps = false;
}
