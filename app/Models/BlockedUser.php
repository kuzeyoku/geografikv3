<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $email)
 */
class BlockedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'ip'
    ];

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeIp($query, $ip)
    {
        return $query->where('ip', $ip);
    }
}
