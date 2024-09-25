<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslate extends Model
{
    protected $fillable = [
        "service_id",
        "lang",
        "title",
        "description"
    ];

    public $timestamps = false;
}
