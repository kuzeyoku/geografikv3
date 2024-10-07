<?php

namespace App\Services;

use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public static function isActive(): bool
    {
        return setting("cache", "status") == StatusEnum::Active->value;
    }

    public static function cacheQuery(string $cacheKey, callable $query)
    {
        return self::isActive()
            ? Cache::remember($cacheKey . "_" . app()->getLocale(), config("cache.time"), $query)
            : $query();
    }
}
