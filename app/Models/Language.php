<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'title',
        'code',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }
}
