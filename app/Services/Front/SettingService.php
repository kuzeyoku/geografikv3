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

    public static function toArray(): array
    {
        $settings = self::getAll();
        return $settings->map(function ($setting) {
            return [
                $setting->category => [
                    $setting->key => $setting->category === 'asset' ? $setting->getFirstMediaUrl() : $setting->value,
                ],
            ];
        })->collapse()->toArray();
    }

    public function getCacheTime()
    {
        return Cache::remember("setting.cache_time", config("cache.time"), function () {
            return intval(Setting::where('key', 'cache_time')->first()->value ?: 60 * 60);
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
