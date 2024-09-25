<?php

namespace App\Enums;

enum ModuleEnum: string
{
    case Message = "message";
    case Media = "media";
    case Menu = "menu";
    case Page = 'page';
    case Language = 'language';
    case Blog = "blog";
    case Category = "category";
    case Sector = "sector";
    case Service = "service";
    case Brand = "brand";
    case Reference = "reference";
    case Product = "product";
    case Project = "project";
    case Slider = "slider";
    case Testimonial = "testimonial";
    case Popup = "popup";
    case User = "user";

    public function title(): string
    {
        return __("admin/$this->value.title");
    }

    public function menuTitle(): string
    {
        return __("admin/$this->value.menu_title");
    }

    public function icon(): string
    {
        return match ($this) {
            self::User => "users",
            self::Message => "mail",
            self::Media => "folder",
            self::Menu => "menu",
            self::Page => 'layout',
            self::Language => 'globe',
            self::Blog => "edit-3",
            self::Category => "list",
            self::Sector => "grid",
            self::Service => "bookmark",
            self::Brand => "tag",
            self::Reference => "refresh-cw",
            self::Product => "shopping-cart",
            self::Project => "briefcase",
            self::Slider => "image",
            self::Testimonial => "smile",
            self::Popup => "maximize-2",
        };
    }

    public function route(): string
    {
        return match ($this) {
            self::User => "user",
            self::Message => "message",
            self::Media => "media",
            self::Menu => "menu",
            self::Page => 'page',
            self::Language => "language",
            self::Blog => "blog",
            self::Category => "category",
            self::Sector => "sector",
            self::Service => "service",
            self::Brand => "brand",
            self::Reference => "reference",
            self::Product => "product",
            self::Project => "project",
            self::Slider => "slider",
            self::Testimonial => "testimonial",
            self::Popup => "popup",
        };
    }

    public function folder(): string
    {
        return match ($this) {
            self::User => "user",
            self::Message => "message",
            self::Media => "media",
            self::Menu => "menu",
            self::Page => 'page',
            self::Language => "language",
            self::Blog => "blog",
            self::Category => "category",
            self::Sector => "sector",
            self::Service => "service",
            self::Brand => "brand",
            self::Reference => "reference",
            self::Product => "product",
            self::Project => "project",
            self::Slider => "slider",
            self::Testimonial => "testimonial",
            self::Popup => "popup",
        };
    }
}
