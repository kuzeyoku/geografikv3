<?php

namespace App\Services\Front;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Popup;
use App\Services\CacheService;

class ThemeService
{
    public static function getPopup()
    {
        return CacheService::cacheQuery("popup", fn() => Popup::active()->first());
    }

    public static function getMenu()
    {
        return CacheService::cacheQuery("menu", fn() => Menu::order()->get());
    }

    public static function getFooter(): array
    {
        $footer["quickLinks"] = CacheService::cacheQuery("footer_quick_links", fn() => Page::active()->where("quick_link", StatusEnum::Yes->value)->get());
        $footer["product_categories"] = CacheService::cacheQuery("footer_product_categories", fn() => Category::module(ModuleEnum::Product)->active()->get());
        return $footer;
    }
}
