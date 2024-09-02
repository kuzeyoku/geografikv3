<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;

class SidebarService
{
    public static function getMenu($module)
    {
        switch ($module) {
            case ModuleEnum::Message->value:
                return [
                    "index" => __("admin/" . ModuleEnum::Message->route() . ".index"),
                    "blocked" => __("admin/" . ModuleEnum::Message->route() . ".blocked"),
                ];
            case ModuleEnum::Media->value:
                return [
                    "index" => __("admin/" . ModuleEnum::Media->route() . ".index"),
                ];
            case ModuleEnum::User->value:
                return [
                    "create" => __("admin/" . ModuleEnum::User->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::User->route() . ".list"),
                ];
            case ModuleEnum::Menu->value:
                return [
                    "index" => __("admin/" . ModuleEnum::Menu->route() . ".index"),
                ];
            case ModuleEnum::Page->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Page->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Page->route() . ".list"),
                ];
            case ModuleEnum::Language->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Language->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Language->route() . ".list"),
                ];
            case ModuleEnum::Blog->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Blog->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Blog->route() . ".list"),
                ];
            case ModuleEnum::Category->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Category->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Category->route() . ".list"),
                ];
            case ModuleEnum::Service->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Service->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Service->route() . ".list"),
                ];
            case ModuleEnum::Brand->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Brand->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Brand->route() . ".list"),
                ];
            case ModuleEnum::Reference->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Reference->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Reference->route() . ".list"),
                ];
            case ModuleEnum::Product->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Product->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Product->route() . ".list"),
                ];
            case ModuleEnum::Project->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Project->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Project->route() . ".list"),
                ];
            case ModuleEnum::Slider->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Slider->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Slider->route() . ".list"),
                ];
            case ModuleEnum::Testimonial->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Testimonial->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Testimonial->route() . ".list"),
                ];
            case ModuleEnum::Popup->value:
                return [
                    "create" => __("admin/" . ModuleEnum::Popup->route() . ".create"),
                    "index" => __("admin/" . ModuleEnum::Popup->route() . ".list"),
                ];
            default:
                return [];
        };
    }
}
