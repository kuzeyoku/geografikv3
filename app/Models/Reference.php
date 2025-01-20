<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Reference extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "url",
        "title",
        "status",
        "order"
    ];

    public function scopeActive($query)
    {
        return $query->where("status", StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order", "asc");
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    public function getModuleAttribute(): string
    {
        return ModuleEnum::Reference->singleTitle();
    }

    public function getImageAttribute(): string
    {
        return cache()->remember("reference_image" . $this->id, config("cache.time"), function () {
            return $this->getFirstMediaUrl() ?? asset("assets/common/images/noimage.jpg");
        });
    }
}
