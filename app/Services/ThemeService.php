<?php

namespace App\Services;

use App\Models\ThemeAsset;
use Illuminate\Support\Facades\Cache;
use App\Services\Admin\SettingService;

class ThemeService
{
    public static function getThemeAssets()
    {
        return Cache::rememberForever('theme_assets', function () {
            $assetData = ThemeAsset::all();
            $response = SettingService::getThemeAssets();
            foreach ($assetData as $asset) {
                $response->{$asset->name} = $asset->getFirstMediaUrl($asset->name);
            }
            return $response;
        });
    }

    public static function getPopup()
    {
        return Cache::remember('popup_' . app()->getLocale(), 3600, function () {
            return \App\Models\Popup::active()->first();
        });
    }

    public static function getAbout()
    {
        return Cache::rememberForever('about_' . app()->getLocale(), function () {
            if (config('information.about_page')) {
                return \App\Models\Page::find(config('information.about_page'));
            }
        });
    }

    public static function getMenu()
    {
        return Cache::rememberForever('menu_' . app()->getLocale(), function () {
            return \App\Models\Menu::order()->get();
        });
    }

    public static function getFooter()
    {
        $footer["quickLinks"] = Cache::rememberForever("footer_quick_links_" . app()->getLocale(), function () {
            return \App\Models\Page::active()->where("quick_link", \App\Enums\StatusEnum::Yes->value)->get();
        });
        return $footer;
    }
}
