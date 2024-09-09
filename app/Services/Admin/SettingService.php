<?php

namespace App\Services\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use stdClass;

class SettingService
{
    public function update(Request $request)
    {
        if ($request->category == "asset") return $this->assetUpload($request);
        $except = $request->except("_token", "_method", "category");
        $settings = array_map(function ($key, $value) use ($request) {
            return ["key" => $key, "value" => $value, "category" => $request->category];
        }, array_keys($except), $except);
        return Setting::upsert($settings, ["key", "category"], ["value"]);
    }

    public function assetUpload($request): void
    {
        foreach ($request->files as $key => $value) {
            if ($request->hasFile($key)) {
                $setting = Setting::where("key", $key)->where("category", "asset")->first();
                if (!$setting) {
                    $setting->clearMediaCollection($key);
                } else {
                    $setting = Setting::create(["key" => $key, "category" => "asset", "value" => "image"]);
                }
                $setting->addMediaFromRequest($key)->usingFileName($key . "." . $request->{$key}->extension())->toMediaCollection();
            }
        }
    }

    public function getCategory($category)
    {
        $settings = Setting::where("category", $category)->get();
        if ($category == "asset") {
            $settings->each(function ($setting) {
                $setting->media_url = $setting->getFirstMediaUrl();
            });
            return $settings->pluck("media_url", "key");
        }
        return $settings->pluck("value", "key");
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
}
