<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTranslate extends Model
{
    use HasFactory;

    protected $fillable = [
        "service_id",
        "lang",
        "title",
        "description"
    ];

    public $timestamps = false;
}
