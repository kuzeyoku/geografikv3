<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

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

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order")->orderBy("id", "DESC");
    }

    public function translate(): HasMany
    {
        return $this->hasMany(ProductTranslate::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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

    public function getTitleAttribute(): string
    {
        return $this->translate->where("lang", $this->locale)->pluck('title')->first();
    }

    public function getDescriptionsAttribute(): array
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute(): string
    {
        return $this->translate->where("lang", $this->locale)->pluck('description')->first();
    }

    public function getFeaturesAttribute(): array
    {
        return $this->translate->pluck("features", "lang")->all();
    }

    public function getFeatureAttribute(): array
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

    public function getShortDescriptionAttribute(): string
    {
        return Str::limit(trim(strip_tags($this->description)), 100);
    }

    public function getMetaDescriptionAttribute(): string
    {
        $description = $this->translate->where("lang", app()->getFallbackLocale())->pluck('description')->first();
        return Str::limit(trim(strip_tags($description)), 160);
    }

    public function getUrlAttribute(): string
    {
        return route(ModuleEnum::Product->route() . ".show", [$this->id, $this->slug]);
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug(request("title." . app()->getFallbackLocale()));
        });
    }
}
