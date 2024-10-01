<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "url",
        "title",
        "order",
        "status"
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

    public function getImageAttribute()
    {
        return cache()->remember("brand_image_{$this->id}", config("cache.time"), function () {
            return $this->getFirstMediaUrl() ?? asset("assets/common/images/noimage.jpg");
        });
    }
}
