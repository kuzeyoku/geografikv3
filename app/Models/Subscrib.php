<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscrib extends Model
{
    protected $fillable = [
        'email',
        'ip',
    ];
}
