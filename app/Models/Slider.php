<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "button",
        "video",
        "status",
        "order"
    ];

    protected $locale;

    protected $with = ["translate"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session("locale");
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order");
    }

    public function translate(): HasMany
    {
        return $this->hasMany(SliderTranslate::class);
    }

    public function getTitleAttribute(): string
    {
        return $this->translate->where("lang", $this->locale)->pluck("title")->first();
    }

    public function getTitlesAttribute(): array
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getDescriptionAttribute(): string
    {
        return $this->translate->where("lang", $this->locale)->pluck("description")->first();
    }

    public function getDescriptionsAttribute(): array
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    public function getModuleAttribute(): string
    {
        return ModuleEnum::Slider->singleTitle();
    }
}
