<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogComment extends Model
{
    public $fillable = [
        "blog_id",
        "name",
        "email",
        "comment",
        "ip",
        "status"
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    public function scopeApproved($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopePending($query)
    {
        return $query->whereStatus(StatusEnum::Pending->value);
    }

    public function getGravatarUrlAttribute(): string
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email)));
    }

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $model->ip = request()->ip();
            $model->status = StatusEnum::Pending->value;
        });
        static::addGlobalScope('order', function ($builder) {
            $builder->orderByDesc('created_at');
        });
    }
}
