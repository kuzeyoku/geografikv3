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
    case Integration = "integration";
    case Asset = "asset";

    public function title(): string
    {
        return __("admin/setting.category_" . $this->value);
    }

    public function status(): Bool
    {
        return match ($this) {
            self::General => true,
            self::System => true,
            self::Pagination => true,
            self::Information => true,
            self::Social => true,
            self::Cache => true,
            self::Contact => true,
            self::Smtp => true,
            self::Maintenance => false,
            self::Sitemap => true,
            self::Seo => true,
            self::Integration => true,
            self::Asset => false,
        };
    }

    public static function has($value): bool
    {
        return in_array($value, self::getValues());
    }

    public static function getValues(): array
    {
        return array_map(fn ($value) => $value->value, self::cases());
    }

    public function existsViewFile(): bool
    {
        return view()->exists("admin.setting." . $this->value);
    }
}
