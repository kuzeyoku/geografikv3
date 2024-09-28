<?php

use App\Enums\StatusEnum;
use App\Http\Middleware\Maintenance;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CountVisitors;

Route::middleware(CountVisitors::class, Maintenance::class)->group(function () {
    Route::get("/", [App\Http\Controllers\HomeController::class, "index"])->name("home");

    if (setting("system", "multilanguage") == StatusEnum::Active->value) {
        Route::post("/setLocale", [App\Http\Controllers\LanguageController::class, "set"])->name("language.set");
    }

    Route::get("/contact", [App\Http\Controllers\ContactController::class, "index"])->name("contact.index");

    Route::post("/contact/send", [App\Http\Controllers\ContactController::class, "send"])->name("contact.send");

    Route::get("/sitemap.xml", [App\Http\Controllers\SitemapController::class, "index"])->name("sitemap.index");

    Route::get("/page/{page}/{slug}", [App\Http\Controllers\PageController::class, "show"])->name("page.show");

    if (config("module.blog.status")) {
        Route::controller(App\Http\Controllers\BlogController::class)->prefix("blog")->group(function () {
            Route::get("/", "index")->name("blog.index");
            Route::get("/{blog}/{slug}", "show")->name("blog.show");
            Route::get("/category/{category}/{slug}", "category")->name("blog.category");
            Route::post("/{blog}/comment/store", "comment_store")->name("blog.comment_store");
        });
    }

    if (config("module.service.status")) {
        Route::controller(App\Http\Controllers\ServiceController::class)->prefix("service")->group(function () {
            Route::get("/", "index")->name("service.index");
            Route::get("/{service}/{slug}", "show")->name("service.show");
            Route::get("/category/{category}/{slug}", "category")->name("service.category");
        });
    }

    if (config("module.product.status")) {
        Route::controller(App\Http\Controllers\ProductController::class)->prefix("product")->group(function () {
            Route::get("/", "index")->name("product.index");
            Route::get("/{product}/{slug}", "show")->name("product.show");
            Route::get("/category/{category}/{slug}", "category")->name("product.category");
        });
    }

    if (config("module.project.status")) {
        Route::controller(App\Http\Controllers\ProjectController::class)->prefix("project")->group(function () {
            Route::get("/", "index")->name("project.index");
            Route::get("/{project}/{slug}", "show")->name("project.show");
            Route::get("/category/{category}/{slug}", "category")->name("project.category");
        });
    }
});

Route::get("maintenance", [App\Http\Controllers\MaintenanceController::class, "index"])->name("maintenance");
