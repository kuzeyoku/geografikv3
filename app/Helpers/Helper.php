<?php

use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Cache;

function languageList()
{
    return Cache::remember('languageList', 3600, function () {
        return \App\Services\Admin\LanguageService::toArray();
    });
}

function statusList()
{
    return Cache::remember('statusList', 3600, function () {
        return StatusEnum::toSelectArray();
    });
}

function themeView($folder, $file)
{
    return config("template.{$folder}.view") . "." . $file;
}

function themeAsset($folder, $file)
{
    return asset("assets/" . config("template.{$folder}.asset") . "/" . $file);
}
