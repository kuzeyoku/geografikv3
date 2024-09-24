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

/**
 * @method static active()
 */
class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'slug',
        'status',
        'category_id',
        'user_id',
        "order"
    ];

    protected $with = ["category", "translate", "user", "comments"];

    public function scopeActive($query)
    {
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order", "asc")->orderBy("id", "desc");
    }

    public function scopeViewOrder($query)
    {
        return $query->orderBy("view_count", "desc");
    }

    public function translate(): HasMany
    {
        return $this->hasMany(BlogTranslate::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute()
    {
        return cache()->remember("blog_image_" . $this->id, config("cache.time"), function () {
            return $this->getFirstMediaUrl();
        });
    }

    public function getPreviousAttribute(): Blog
    {
        return $this->where("id", ">", $this->id)->orderBy("id", "ASC")->first();
    }

    public function getNextAttribute(): Blog
    {
        return $this->where("id", "<", $this->id)->orderBy("id", "ASC")->first();
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", app()->getLocale())->pluck('title')->first();
    }

    public function getTitlesAttribute(): array
    {
        return $this->translate->pluck('title', "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", app()->getLocale())->pluck('description')->first();
    }

    public function getDescriptionsAttribute(): array
    {
        return $this->translate->pluck('description', "lang")->all();
    }

    public function getTagsAttribute(): array
    {
        return $this->translate->pluck('tags', "lang")->all();
    }

    public function getTagsToArrayAttribute(): array
    {
        return explode(",", $this->translate->pluck('tags', "lang")->first());
    }

    public function getShortDescriptionAttribute(): string
    {
        return Str::limit(strip_tags($this->description), 90);
    }

    public function getMetaDescriptionAttribute(): string
    {
        $description = $this->translate->where("lang", app()->getFallbackLocale())->pluck('description')->first();
        return Str::limit(strip_tags($description), 160);
    }

    public function getUrlAttribute(): string
    {
        return route(ModuleEnum::Blog->route() . ".show", [$this->id, $this->slug]);
    }

    public function getCategoryUrlAttribute(): string
    {
        return route(ModuleEnum::Blog->route() . ".category", [$this->category->id, $this->category->slug]);
    }

    public function getStatusViewAttribute(): string
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    public function getModuleAttribute()
    {
        return ModuleEnum::Blog->singleTitle();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = \Illuminate\Support\Facades\Auth::id();
            $model->slug = Str::slug(request("title." . app()->getFallbackLocale()));
        });
    }
}
