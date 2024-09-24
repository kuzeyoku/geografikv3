<?php

namespace App\Services\Front;

use App\Models\ThemeAsset;
use Artesaos\SEOTools\Facades\SEOTools;

class SeoService
{

    private static function default(): void
    {
        SEOTools::opengraph()->addProperty("type", "website");
    }

    public static function index(): void
    {
        self::default();
        SEOTools::setTitle(config("general.title"));
        SEOTools::setDescription(config("general.description"));
    }

    public static function module($module): void
    {
        self::default();
        SEOTools::setTitle(__("front/$module->value.meta_title") ?: config("general.title"));
        SEOTools::setDescription(__("front/$module->value.meta_description") ?: config("general.description"));
    }

    public static function category($category): void
    {
        self::default();
        SEOTools::setTitle($category->title);
        SEOTools::setDescription($category->meta_description);
        SEOTools::opengraph()->addImage($category->image ?: asset("assets/common/cover.jpg"));
        SEOTools::twitter()->setImage($category->image ?: asset("assets/common/cover.jpg"));
    }

    public static function show($item): void
    {
        self::default();
        SEOTools::setTitle($item->title);
        SEOTools::setDescription($item->meta_description);
        if (method_exists($item, "hasMedia")) {
            SEOTools::opengraph()->addImage($item->image ?: asset("assets/common/cover.jpg"));
            SEOTools::twitter()->setImage($item->image ?: asset("assets/common/cover.jpg"));
        }
    }
}
