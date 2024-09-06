<?php

namespace App\Providers;

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
            $themeAsset = \App\Services\Front\ThemeService::getThemeAssets();
            $view->with(compact("themeAsset"));
        });

        View::composer(["common.popup"], function ($view) {
            $popup = \App\Services\Front\ThemeService::getPopup();
            $view->with(compact("popup"));
        });

        View::composer("layout.about", function ($view) {
            $about = \App\Services\Front\ThemeService::getAbout();
            $view->with(compact("about"));
        });

        View::composer("layout.header", function ($view) {
            $menu = \App\Services\Front\ThemeService::getMenu();
            $view->with(compact("menu"));
        });

        View::composer('layout.footer', function ($view) {
            $footer = \App\Services\Front\ThemeService::getFooter();
            $view->with(compact("footer"));
        });
    }
}
