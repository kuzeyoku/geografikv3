<?php

namespace App\Models;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "status",
        "order",
        "slug",
        "category_id",
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
        return $query->whereStatus(StatusEnum::Active->value);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order");
    }

    public function translate()
    {
        return $this->hasMany(ServiceTranslate::class);
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
        return $this->translate->where("lang", $this->locale)->pluck("title")->first();
    }

    public function getDescriptionsAttribute()
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck("description")->first();
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 100);
    }

    public function getMetaDescriptionAttribute()
    {
        $description = $this->translate->where("lang", app()->getFallbackLocale())->pluck('description')->first();
        return Str::limit(strip_tags($description), 160);
    }

    public function getUrlAttribute()
    {
        return route(ModuleEnum::Service->route() . ".show", [$this, $this->slug]);
    }

    public function getOtherAttribute()
    {
        return Service::active()->where("id", "!=", $this->id)->limit(5)->get();
    }

    public function getStatusViewAttribute()
    {
        return StatusEnum::fromValue($this->status)->badge();
    }

    public function getModuleAttribute()
    {
        return ModuleEnum::Service->singleTitle();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug(request("title." . app()->getFallbackLocale()));
        });
    }
}
