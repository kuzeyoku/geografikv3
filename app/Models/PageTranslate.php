<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslate extends Model
{
    protected $table = 'page_translates';

    protected $fillable = [
        'page_id',
        'lang',
        'title',
        'description',
    ];

    public  $timestamps = false;
}
