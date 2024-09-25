<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sector extends Model
{
    use InteractsWithMedia;

    protected $fillable = [
        'url',
        'order',
        'status',
    ];
}
