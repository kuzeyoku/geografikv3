<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sector extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'url',
        'order',
        'status',
    ];

    protected $with = ['translate'];

    public function translate(): HasMany
    {
        return $this->hasMany(SectorTranslate::class);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', StatusEnum::Active->value);
    }

    public function getImageAttribute()
    {
        return cache()->remember("sector_image_" . $this->id, config("cache.time"), function () {
            return $this->getFirstMediaUrl();
        });
    }

    public function getTitlesAttribute(): array
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute(): string
    {
        return $this->translate->where("lang", app()->getFallbackLocale())->pluck("title")->first();
    }
}
