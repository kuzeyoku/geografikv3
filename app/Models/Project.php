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
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "slug",
        "category_id",
        "video",
        "model3D",
        "order",
        "status"
    ];

    protected mixed $locale;

    protected $with = ["translate", "category"];

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
        return $query->orderBy("order")->orderBy("id", "DESC");
    }

    public function translate(): HasMany
    {
        return $this->hasMany(ProjectTranslate::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getPreviousAttribute(): Project
    {
        return $this->where("id", ">", $this->id)->orderBy("id", "ASC")->first();
    }

    public function getNextAttribute(): Project
    {
        return $this->where("id", "<", $this->id)->orderBy("id", "ASC")->first();
    }

    public function getTitlesAttribute(): array
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck("title")->first();
    }

    public function getDescriptionsAttribute(): array
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck("description")->first();
    }

    public function getFeaturesAttribute(): array
    {
        return $this->translate->pluck("features", "lang")->toArray();
    }

    public function getFeatureAttribute(): array
    {
        $result = [];
        if (array_key_exists($this->locale, $this->features)) {
            $featuresLine = array_filter(explode("\r\n", $this->features[$this->locale]), function ($item) {
                return !empty($item);
            });
            array_map(function ($item) use (&$result) {
                list($key, $value) = explode(":", $item);
                $result[$key] = $value;
            }, $featuresLine);
        }
        return $result;
    }

    public function getShortDescriptionAttribute(): string
    {
        return Str::limit("strip_tags($this->description)", 100);
    }

    public function getMetaDescriptionAttribute(): string
    {
        $description = $this->translate->where("lang", app()->getFallbackLocale())->pluck('description')->first();
        return Str::limit(strip_tags($description), 160);
    }

    public function getUrlAttribute(): string
    {
        return route(ModuleEnum::Project->route() . ".show", [$this, $this->slug]);
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
