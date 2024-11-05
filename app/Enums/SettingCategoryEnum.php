<?php

namespace App\Enums;

enum SettingCategoryEnum: string
{
    case General = "general";
    case System = "system";
    case Pagination = "pagination";
    case Information = "information";
    case Social = "social";
    case Cache = "cache";
    case Contact = "contact";
    case Smtp = "smtp";
    case Maintenance = "maintenance";
    case Sitemap = "sitemap";
    case Seo = "seo";
    case Webmaster = "webmaster";
    case Integration = "integration";
    case Asset = "asset";

    public function title(): string
    {
        return __("admin/setting.category_" . $this->value);
    }

    public static function has($value): bool
    {
        return in_array($value, self::getValues());
    }

    public static function getValues(): array
    {
        return array_map(fn($value) => $value->value, self::cases());
    }
}
