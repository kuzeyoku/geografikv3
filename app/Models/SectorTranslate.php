<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectorTranslate extends Model
{
    protected $fillable = [
        'sector_id',
        'lang',
        'title',
    ];

    public $timestamps = false;
}
