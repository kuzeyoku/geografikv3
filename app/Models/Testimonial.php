<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "name",
        "company",
        "position",
        "message",
        "status",
        "order"
    ];

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order");
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

}
