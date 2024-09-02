<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "status",
        "slug",
        "category_id",
        "brochure",
        "video",
        "order"
    ];

    protected $locale;

    protected $with = ["translate", "category"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session("locale");
    }

    public function scopeActive()
    {
        return $this->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder()
    {
        return $this->orderBy("order")->orderByDesc("id");
    }

    public function translate()
    {
        return $this->hasMany(ProductTranslate::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function getFeaturesAttribute()
    {
        return $this->translate->pluck("features", "lang")->all();
    }

    public function getFeatureAttribute()
    {
        $result = [];
        if (array_key_exists($this->locale, $this->features)) {
            $featuresLine = array_filter(explode("\r\n", $this->features[$this->locale]), function ($item) {
                return !empty($item);
            });
            $result = [];
            array_map(function ($item) use (&$result) {
                list($key, $value) = explode(":", $item);
                $result[$key] = $value;
            }, $featuresLine);
            return $result;
        }
        return $result;
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(trim(strip_tags($this->description)), 100);
    }

    public function getMetaDescriptionAttribute()
    {
        $description = $this->translate->where("lang", app()->getFallbackLocale())->pluck('description')->first();
        return Str::limit(trim(strip_tags($description)), 160);
    }

    public function getUrlAttribute()
    {
        return route(ModuleEnum::Product->route() . ".show", [$this->id, $this->slug]);
    }

    public function getStatusViewAttribute()
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug(request("title." . app()->getFallbackLocale()));
        });
    }
}
