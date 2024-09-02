<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslate extends Model
{
    use HasFactory;

    protected $table = 'page_translates';

    protected $fillable = [
        'page_id',
        'lang',
        'title',
        'description',
    ];

    public  $timestamps = false;
}
