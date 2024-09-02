<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class SettingService
{
    public function __construct() {}

    public static function getAll(): Collection
    {
        return Cache::remember("settings", config("cache.time"), function () {
            return Setting::all();
        });
    }

    public static function toArray()
    {
        $settings = self::getAll();
        $config = [];
        $settings->each(function ($setting) use (&$config) {
            $config[$setting->category][$setting->key] = $setting->value;
        });
        return $config;
    }

    public static function get($category, $key)
    {
        return Cache::remember("setting.{$key}", config("cache.time"), function () use ($key, $category) {
            return self::getAll()->where(["category" => $category, "key" => $key])->first()?->value;
        });
    }

    public function getCacheTime()
    {
        return Cache::remember("setting.cache_time", config("cache.time"), function () {
            return intval(Setting::where('key', 'cache_time')->first()->value ?: 60 * 60);
        });
    }
}
