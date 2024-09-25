<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "name",
        "email",
        "phone",
        "subject",
        "message",
        "ip",
        "user_agent",
        "consent",
        "status"
    ];

    public function scopeUnread($query)
    {
        return $query->whereStatus(StatusEnum::Unread);
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('order', function ($builder) {
            $builder->orderByDesc('created_at');
        });
    }
}
