<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'status',
        'module',
        'parent_id',
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
        return $query->orderBy("order", "asc");
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, "parent_id");
    }

    public function translate()
    {
        return $this->hasMany(CategoryTranslate::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('title')->first();
    }

    public function getTitlesAttribute()
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getDescriptionAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('description')->first();
    }

    public function getDescriptionsAttribute()
    {
        return $this->translate->pluck("description", "lang")->all();
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($category) {
            $category->slug = Str::slug(request("title." . app()->getFallbackLocale()));
        });
        self::deleting(function ($category) {
            $category->products()->update(["category_id" => 0]);
            $category->projects()->update(["category_id" => 0]);
            $category->services()->update(["category_id" => 0]);
            $category->blogs()->update(["category_id" => 0]);
            $category->subCategories()->delete();
        });
    }

    public function getStatusViewAttribute()
    {
        return StatusEnum::fromValue($this->status)->badge();
    }
}
