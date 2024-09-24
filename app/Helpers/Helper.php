<?php

use App\Enums\StatusEnum;
use App\Services\Admin\LanguageService;
use Illuminate\Support\Facades\Cache;

function languageList(): mixed
{
    return Cache::remember('languageList', 3600, function () {
        return LanguageService::toArray();
    });
}

function statusList(): mixed
{
    return Cache::remember('statusList', 3600, function () {
        return StatusEnum::toSelectArray();
    });
}

function themeView($folder, $file): string
{
    return config("template.{$folder}.view") . "." . $file;
}

function themeAsset($folder, $file): string
{
    return asset("assets/" . config("template.{$folder}.asset") . "/" . $file);
}

function setting($category, $key = null): mixed
{
    $settings = App\Services\Front\SettingService::toArray();
    if (is_null($key)) {
        return $settings[$category] ?? [];
    }
    return $settings[$category][$key] ?? null;
}
