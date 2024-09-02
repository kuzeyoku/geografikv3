<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public static function status()
    {
        if (Setup::first())
            return Setup::first()->status;
        return "not_installed";
    }

    public $timestamps = false;
}
