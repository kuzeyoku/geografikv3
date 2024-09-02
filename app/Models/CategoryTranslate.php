<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslate extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'lang',
        'title',
        'description'
    ];

    public $timestamps = false;
}
