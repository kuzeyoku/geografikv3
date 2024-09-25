<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslate extends Model
{
    protected $fillable = [
        'blog_id',
        'lang',
        'title',
        'description',
        'tags'
    ];

    public $timestamps = false;
}
