<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        "ip_address",
        "visit_count"
    ];

    public static function getOnlineUsers()
    {
        return self::where("updated_at", '>=', now()->subMinutes(15))->distinct()->count("ip_address");
    }

    public static function getTodaySingleVisits()
    {
        return self::where("updated_at", ">=", now()->startOfDay())->distinct()->count("ip_address");
    }
}
