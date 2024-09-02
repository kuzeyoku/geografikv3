<?php

namespace App\Providers;

use App\Enums\StatusEnum;
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
        View::composer(["layout.*", "contact", "admin.setting.asset"], function ($view) {
            $themeAsset = \App\Services\ThemeService::getThemeAssets();
            $view->with(compact("themeAsset"));
        });

        View::composer(["common.popup"], function ($view) {
            $popup = \App\Services\ThemeService::getPopup();
            $view->with(compact("popup"));
        });

        View::composer("layout.about", function ($view) {
            $about = \App\Services\ThemeService::getAbout();
            $view->with(compact("about"));
        });

        View::composer("layout.header", function ($view) {
            $menu = \App\Services\ThemeService::getMenu();
            $view->with(compact("menu"));
        });

        View::composer('layout.footer', function ($view) {
            $footer = \App\Services\ThemeService::getFooter();
            $view->with(compact("footer"));
        });
    }
}
