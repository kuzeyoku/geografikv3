<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Models\PopupTranslate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Popup extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "type",
        "image",
        "video",
        "url",
        "setting",
        "status"
    ];

    protected $locale;

    protected $with = ["translate"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session("locale");
    }

    public function translate()
    {
        return $this->hasMany(PopupTranslate::class);
    }

    public function scopeActive($query)
    {
        return $query->where("status", \App\Enums\StatusEnum::Active->value);
    }

    public function getTitlesAttribute()
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('title')->first();
    }

    public function getDescriptionsAttribute()
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('description')->first();
    }

    public function getSettingsAttribute()
    {
        return json_decode($this->setting);
    }

    public function getModuleAttribute()
    {
        return ModuleEnum::Popup->title();
    }
}
