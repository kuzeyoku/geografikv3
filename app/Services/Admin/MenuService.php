<?php

namespace App\Services\Admin;

use App\Models\Menu;
use App\Models\Page;
use App\Enums\ModuleEnum;

class MenuService extends BaseService
{
    public function __construct(Menu $menu)
    {
        parent::__construct($menu, ModuleEnum::Menu);
    }

    public function getUrlList(): array
    {

        $pages =  Page::active()->get()->each(function ($item) {
            $item->title = $item->title;
            $item->url = $item->url;
        })->pluck("title", "url");

        return [
            route("home") => __("admin/general.home"),
            route(ModuleEnum::Blog->Route() . ".index") => ModuleEnum::Blog->title(),
            route(ModuleEnum::Product->Route() . ".index") => ModuleEnum::Product->title(),
            route(ModuleEnum::Project->Route() . ".index") => ModuleEnum::Project->title(),
            route("contact.index") => __("front/contact.txt1"),
            "Sayfalar" => $pages ?? [],
        ];
    }
}
