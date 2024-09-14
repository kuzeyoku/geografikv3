<?php

namespace App\Services\Front;

use App\Enums\StatusEnum;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public function __construct()
    {
    }

    public static function getAll(): Collection
    {
        return Cache::remember("settings", config("cache.time"), function () {
            return Setting::all();
        });
    }

    public static function get($category, $key)
    {
        return Cache::remember("setting.{$key}", config("cache.time"), function () use ($key, $category) {
            return self::getAll()->where(["category" => $category, "key" => $key])->first()?->value;
        });
    }

    public static function toArray()
    {
        $settings = self::getAll();
        return Cache::remember("setting.array", config("cache.time"), function () use ($settings) {
            return $settings->groupBy('category')->map(function ($group) {
                if ($group->first()->category == "asset") {
                    $group->each(function ($setting) {
                        $setting->media = $setting->getFirstMediaUrl();
                    });
                    return $group->pluck('media', 'key');
                }
                return $group->pluck('value', 'key');
            })->toArray();
        });
    }

    public static function getCacheTime()
    {
        return Cache::remember("setting.cache_time", config("cache.time"), function () {
            return intval(Setting::where('key', 'time')->first()?->value ?: 60 * 60);
        });
    }

    public static function cacheIsActive(): bool
    {
        return config("cache.status", StatusEnum::Passive->value) == StatusEnum::Active->value;
    }

    public static function recaptchaIsActive(): bool
    {
        return config("recaptcha.status", StatusEnum::Passive->value) == StatusEnum::Active->value;
    }
}
