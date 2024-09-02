<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

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

    public function translate()
    {
        return $this->hasMany(MenuTranslate::class);
    }

    public function subMenu()
    {
        return $this->hasMany(Menu::class, "parent_id");
    }

    public function scopeOrder($query)
    {
        return $query->orderBy("order");
    }

    public function getTitlesAttribute()
    {
        return  $this->translate->pluck("title", "lang")->all();
    }

    public function getTitleAttribute()
    {
        return $this->translate->where("lang", $this->locale)->pluck('title')->first();
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($model) {
            $model->subMenu()->delete();
        });
    }
}
