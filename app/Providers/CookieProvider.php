<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CookieProvider extends ServiceProvider
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
        if (setting("information", "cookie_notification_status") == \App\Enums\StatusEnum::Active->value) {
            $page = cache()->remember("cookie_policy_page", config("cache.time"), function () {
                return \App\Models\Page::findOrFail(setting("information", "cookie_policy_page"));
            });
            dd($page);
            view()->composer("common.cookie_alert", function ($view) use ($page) {
                $view->with(compact("page"));
            });
        }
    }
}
