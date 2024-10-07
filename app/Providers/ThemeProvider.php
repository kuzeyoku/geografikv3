<?php

namespace App\Providers;

use App\Services\Front\ThemeService;
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
        View::composer(["common.popup"], function ($view) {
            $popup = ThemeService::getPopup();
            $view->with(compact("popup"));
        });

        View::composer("layout.header", function ($view) {
            $menu = ThemeService::getMenu();
            $view->with(compact("menu"));
        });

        View::composer('layout.footer', function ($view) {
            $footer = ThemeService::getFooter();
            $view->with(compact("footer"));
        });
    }
}
