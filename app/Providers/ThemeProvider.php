<?php

namespace App\Providers;

use App\Services\CacheService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ThemeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(["layout.main"], function ($view) {
            $popup = CacheService::cacheQuery("popup", fn() => (new \App\Models\Popup)->active()->first());
            $view->with(compact("popup"));
            $menu = CacheService::cacheQuery("menu", fn() => (new \App\Models\Menu)->order()->get());
            $view->with(compact("menu"));
            $footer["quickLinks"] = CacheService::cacheQuery("footer_quicklinks", fn() => (new \App\Models\Page)->where("quick_link", \App\Enums\StatusEnum::Yes)->get());
            $footer["product_categories"] = CacheService::cacheQuery("footer_product_categories", fn() => (new \App\Models\Category)->module(\App\Enums\ModuleEnum::Product)->active()->get());
            $view->with(compact("footer"));
        });
    }
}
