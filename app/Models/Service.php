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

class Service extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "status",
        "order",
        "slug",
        "category_id",
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
        return $this->hasMany(ServiceTranslate::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute(): string
    {
        return \Cache::remember("service_image_" . $this->id, config("cache.time"), function () {
            return $this->getFirstMediaUrl() ?? asset("assets/img/default.jpg");
        });
    }

    public function getTitlesAttribute(): array
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute(): string|null
    {
        return $this->translate->where("lang", $this->locale)->pluck("title")->first();
    }

    public function getDescriptionsAttribute(): array
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute(): string|null
    {
        return $this->translate->where("lang", $this->locale)->pluck("description")->first();
    }

    public function getShortDescriptionAttribute(): string
    {
        return Str::limit(strip_tags($this->description), 100);
    }

    public function getMetaDescriptionAttribute(): string
    {
        $description = $this->translate->where("lang", app()->getFallbackLocale())->pluck('description')->first();
        return Str::limit(strip_tags($description), 160);
    }

    public function getUrlAttribute(): string
    {
        return route(ModuleEnum::Service->route() . ".show", [$this, $this->slug]);
    }

    public function getOtherAttribute()
    {
        return Service::active()->where("id", "!=", $this->id)->limit(5)->get();
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    public function getModuleAttribute(): string
    {
        return ModuleEnum::Service->singleTitle();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug(request("title." . app()->getFallbackLocale()));
        });
    }
}
