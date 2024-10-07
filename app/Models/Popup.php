<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Popup extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "type",
        "video",
        "url",
        "setting",
        "status"
    ];

    protected $with = ["translate"];

    public function translate(): HasMany
    {
        return $this->hasMany(PopupTranslate::class);
    }

    public function scopeActive($query)
    {
        return $query->where("status", StatusEnum::Active->value);
    }

    public function getImageAttribute()
    {
        return cache()->remember("product_image_" . $this->id, config("cache.time"), function () {
            return $this->getFirstMediaUrl() ?? asset("assets/common/images/noimage.jpg");
        });
    }

    public function getTitlesAttribute(): array
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", session("locale"))->pluck('title')->first();
    }

    public function getDescriptionsAttribute(): array
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", session("locale"))->pluck('description')->first();
    }

    public function getSettingsAttribute()
    {
        return json_decode($this->setting);
    }

    public function getModuleAttribute(): string
    {
        return ModuleEnum::Popup->title();
    }
}
