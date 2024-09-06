<?php

namespace App\Services\Admin;

use App\Models\Setting;
use App\Models\ThemeAsset;
use Illuminate\Http\Request;
use stdClass;

class SettingService
{
    public function route(): string
    {
        return "setting";
    }

    public function folder(): string
    {
        return "setting";
    }

    public function update(Request $request)
    {
        if ($request->category == "asset") {
            foreach ($request->files as $key => $file) {
                if ($request->hasFile($key)) {
                    $asset = ThemeAsset::where("name", $key)->first();
                    if ($asset) {
                        $asset->clearMediaCollection($key);
                    } else {
                        $asset = ThemeAsset::create(["name" => $key]);
                    }
                    try {
                        $asset->addMediaFromRequest($key)->usingFileName($key . "." . $request->{$key}->extension())->toMediaCollection($key);
                        cache()->forget("theme_assets");
                    } catch (\Exception $e) {
                        //Exception
                    }
                }
            }
            return;
        }
        $except = $request->except("_token", "_method", "category");
        $settings = array_map(function ($key, $value) use ($request) {
            return ["key" => $key, "value" => $value, "category" => $request->category];
        }, array_keys($except), $except);
        return Setting::upsert($settings, ["key", "category"], ["value"]);
    }

    public function getCategory($category)
    {
        $settings = Setting::where("category", $category)->get();
        return config()->set($category, $settings->pluck("value", "key"));
    }

    public static function getSitemapModuleList()
    {
        $arr = ["home"];
        if (config("module.page.status")) array_push($arr, "static_pages");
        if (config("module.blog.status")) array_push($arr, "blog", "blog_category", "blog_detail");
        if (config("module.service.status")) array_push($arr, "service", "service_category", "service_detail");
        if (config("module.product.status")) array_push($arr, "product", "product_category", "product_detail");
        if (config("module.project.status")) array_push($arr, "project", "project_category", "project_detail");
        return $arr;
    }

    public static function getChangeFreqList(): array
    {
        return [
            "always" => __("admin/setting.sitemap_changefreq_always"),
            "hourly" => __("admin/setting.sitemap_changefreq_hourly"),
            "daily" => __("admin/setting.sitemap_changefreq_daily"),
            "weekly" => __("admin/setting.sitemap_changefreq_weekly"),
            "monthly" => __("admin/setting.sitemap_changefreq_monthly"),
            "yearly" => __("admin/setting.sitemap_changefreq_yearly"),
            "never" => __("admin/setting.sitemap_changefreq_never"),
        ];
    }

    public static function getThemeAssets(): stdClass
    {
        $asset = new stdClass();
        $asset->logo_light = null;
        $asset->logo_dark = null;
        $asset->favicon = null;
        $asset->cover = null;
        $asset->breadcrumb = null;
        $asset->about1 = null;
        $asset->about2 = null;
        $asset->hire_area = null;
        $asset->counter = null;
        return $asset;
    }
}
