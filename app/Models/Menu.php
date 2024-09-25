<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        "url",
        "parent_id",
        "order",
        "blank",
    ];

    public $timestamps = false;

    protected $locale;

    protected $with = ["translate", "subMenu"];

    public function __construct()
    {
        parent::__construct();
        $this->locale = session("locale");
    }

    public function translate(): HasMany
    {
        return $this->hasMany(MenuTranslate::class);
    }

    public function subMenu(): HasMany
    {
        return $this->hasMany(Menu::class, "parent_id");
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order");
    }

    public function getTitlesAttribute(): array
    {
        return $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute(): string
    {
        return $this->translate->where("lang", $this->locale)->pluck('title')->first();
    }

    public static function boot(): void
    {
        parent::boot();
        self::deleting(function ($model) {
            $model->subMenu()->delete();
        });
    }
}
