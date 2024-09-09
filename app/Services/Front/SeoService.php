<?php

namespace App\Services\Front;

use App\Models\ThemeAsset;
use Artesaos\SEOTools\Facades\SEOTools;

class SeoService
{

    private static function default()
    {
        SEOTools::opengraph()->addProperty("type", "website");
    }

    public static function index()
    {
        self::default();
        SEOTools::setTitle(config("general.title"));
        SEOTools::setDescription(config("general.description"));
    }

    public static function module($module)
    {
        self::default();
        SEOTools::setTitle(__("front/$module.meta_title") ?: config("general.title"));
        SEOTools::setDescription(__("front/$module.meta_description") ?: config("general.description"));
    }

    public static function show($item)
    {
        self::default();
        SEOTools::setTitle($item->title);
        SEOTools::setDescription($item->meta_description);
        SEOTools::opengraph()->addImage($item->getFirstMediaUrl("cover") ?: asset("assets/common/cover.jpg"));
        SEOTools::twitter()->setImage($item->getFirstMediaUrl("cover") ?: asset("assets/common/cover.jpg"));
    }
}
