<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix(setting("system", "admin", "admin"))->name('admin.')->group(function () {
    //Auth Routes
    Route::controller(\App\Http\Controllers\Admin\AuthController::class)->prefix("auth")->group(function () {
        Route::get('login', 'login')->name('auth.login');
        Route::get("forgot-password", "forgot_password_view")->name("auth.forgot_password_view");
        Route::post('forgot-password', "forgot_password")->name("auth.forgot_password");
        Route::get('reset-password/{token}', "reset_password_view")->name("auth.reset_password_view");
        Route::post("reset-password", "reset_password")->name("auth.reset_password");
        Route::post('authenticate', 'authenticate')->name('auth.authenticate');
    });

    Route::middleware(['auth', Admin::class])->group(function () {
        //Logout Route
        Route::get('logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('auth.logout');
        //Home Route
        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');
        //Setting Routes
        Route::controller(App\Http\Controllers\Admin\SettingController::class)->prefix('setting')->group(function () {
            Route::get('/{category}', 'index')->name('setting');
            Route::put('/update', 'update')->name('setting.update');
        });
        //Media Routes
        Route::controller(App\Http\Controllers\Admin\MediaController::class)->prefix('media')->group(function () {
            Route::get('/', 'index')->name('media.index');
            Route::post('/upload', 'store')->name('media.upload');
            Route::delete('/{id}/delete', 'destroy')->name('media.destroy');
        });
        //Message Routes
        Route::controller(App\Http\Controllers\Admin\MessageController::class)->prefix("message")->group(function () {
            Route::get("/", "index")->name("message.index");
            Route::get("/create", "create")->name("message.create");
            Route::get("/{message}/show", "show")->name("message.show");
            Route::get("/{message}/reply", "reply")->name("message.reply");
            Route::post("/{message}/sendReply", "sendReply")->name("message.sendReply");
            Route::delete("/{message}/destroy", "destroy")->name("message.destroy");
            Route::post("/{message}/block", "block")->name("message.block");
            Route::get("/user/blocked", "blocked")->name("message.blocked");
            Route::delete("/user/{id}/unblock", "unblock")->name("message.unblock");
        });
        //Menu Routes
        Route::resource("menu", App\Http\Controllers\Admin\MenuController::class)->names('menu');
        Route::controller(App\Http\Controllers\Admin\MenuController::class)->prefix('menu')->group(function () {
            Route::get('/header', 'header')->name('menu.header');
        });
        //Page Routes
        Route::resource("page", App\Http\Controllers\Admin\PageController::class)->names('page');
        Route::controller(\App\Http\Controllers\Admin\PageController::class)->prefix("page")->group(function () {
            Route::put("/{page}/status-update", "statusUpdate")->name("page.status_update");
        });
        //User Routes
        Route::resource("user", App\Http\Controllers\Admin\UserController::class)->names('user');
        //Language Routes
        Route::resource("language", App\Http\Controllers\Admin\LanguageController::class)->names('language');
        Route::controller(App\Http\Controllers\Admin\LanguageController::class)->prefix("language")->group(function () {
            Route::put("/{language}/status-update", "statusUpdate")->name("language.status_update");
            Route::match(["get", "post"], "/{language}/files", "files")->name("language.files");
            Route::post("/{language}/getFileContent", "getFileContent")->name("language.getFileContent");
            Route::put("/{language}/updateFileContent", "updateFileContent")->name("language.updateFileContent");
        });
        //Category Routes
        Route::resource("category", App\Http\Controllers\Admin\CategoryController::class)->names('category');
        Route::controller(App\Http\Controllers\Admin\CategoryController::class)->prefix("category")->group(function () {
            Route::put("/{category}/status-update", "statusUpdate")->name("category.status_update");
        });
        //Sector Routes
        Route::resource("sector", App\Http\Controllers\Admin\SectorController::class)->names('sector');
        Route::controller(App\Http\Controllers\Admin\SectorController::class)->prefix("sector")->group(function () {
            Route::put("/{sector}/status-update", "statusUpdate")->name("sector.status_update");
        });
        //Service routes
        Route::resource("service", App\Http\Controllers\Admin\ServiceController::class)->names('service');
        Route::controller(App\Http\Controllers\Admin\ServiceController::class)->prefix("service")->group(function () {
            Route::put("/{service}/status-update", "statusUpdate")->name("service.status_update");
        });
        //Project Routes
        Route::resource("project", App\Http\Controllers\Admin\ProjectController::class)->names('project');
        Route::controller(App\Http\Controllers\Admin\ProjectController::class)->prefix("project")->group(function () {
            Route::put("/{project}/status-update", "statusUpdate")->name("project.status_update");
            Route::get("/{project}/image", "image")->name("project.image");
            Route::post("/{project}/imageStore", "imageStore")->name("project.imageStore");
            Route::delete("/{image}/imageDelete", "imageDelete")->name("project.imageDelete");
            Route::delete("/{project}/imageAllDelete", "imageAllDelete")->name("project.imageAllDelete");
        });
        //Product Routes
        Route::resource("product", App\Http\Controllers\Admin\ProductController::class)->names('product');
        Route::controller(App\Http\Controllers\Admin\ProductController::class)->prefix("product")->group(function () {
            Route::put("/{product}/status-update", "statusUpdate")->name("product.status_update");
            Route::get("/{product}/image", "image")->name("product.image");
            Route::post("/{product}/imageStore", "imageStore")->name("product.imageStore");
            Route::delete("/{image}/imagedelete", "imageDelete")->name("product.imageDelete");
            Route::delete("/{product}/imagealldelete", "imageAllDelete")->name("product.imageAllDelete");
        });
        //Slider Routes
        Route::resource("slider", App\Http\Controllers\Admin\SliderController::class)->names('slider');
        Route::controller(App\Http\Controllers\Admin\SliderController::class)->prefix("slider")->group(function () {
            Route::put("/{slider}/status-update", "statusUpdate")->name("slider.status_update");
        });
        //Brand Routes
        Route::resource("brand", App\Http\Controllers\Admin\BrandController::class)->names('brand');
        Route::controller(App\Http\Controllers\Admin\BrandController::class)->prefix("brand")->group(function () {
            Route::put("/{brand}/status-update", "statusUpdate")->name("brand.status_update");
        });
        //Reference Routes
        Route::resource("reference", App\Http\Controllers\Admin\ReferenceController::class)->names('reference');
        Route::controller(App\Http\Controllers\Admin\ReferenceController::class)->prefix("reference")->group(function () {
            Route::put("/{reference}/status-update", "statusUpdate")->name("reference.status_update");
        });
        //Testimonial Routes
        Route::resource("testimonial", App\Http\Controllers\Admin\TestimonialController::class)->names('testimonial');
        Route::controller(App\Http\Controllers\Admin\TestimonialController::class)->prefix("testimonial")->group(function () {
            Route::put("/{testimonial}/status-update", "statusUpdate")->name("testimonial.status_update");
        });
        //Popup Routes
        Route::resource("popup", App\Http\Controllers\Admin\PopupController::class)->names('popup');
        Route::controller(App\Http\Controllers\Admin\PopupController::class)->prefix("popup")->group(function () {
            Route::put("/{popup}/status-update", "statusUpdate")->name("popup.status_update");
        });
        //Blog Routes
        Route::resource('blog', App\Http\Controllers\Admin\BlogController::class)->names('blog');
        Route::controller(App\Http\Controllers\Admin\BlogController::class)->prefix("blog")->group(function () {
            Route::put("/{blog}/status-update", "statusUpdate")->name("blog.status_update");
            Route::get("/{blog}/comment", "comment")->name("blog.comment");
            Route::put("/blog/{comment}/commentStatusChange", "commentStatusChange")->name("blog.comment_status_change");
            Route::delete("/comment/{comment}/delete", "comment_delete")->name("blog.comment_delete");
        });

        //Notification Routes
        Route::prefix("notification")->name("notification.")->group(function () {
            Route::get("{notification}/read", function ($notification) {
                $notification = Auth::user()->notifications->find($notification)->markAsRead();
                return back();
            })->name("read");
            Route::get("mark-all-as-read", function () {
                Auth::user()->unreadNotifications->markAsRead();
                return back();
            })->name("mark_all_as_read");
        });

        Route::post("editor/upload", [App\Http\Controllers\Admin\EditorController::class, "store"])->name("editor.upload");
        Route::get("cache-clear", [App\Http\Controllers\Admin\HomeController::class, "cacheClear"])->name("cache_clear");
        // Route::get("log-clear/{file}", [App\Http\Controllers\Admin\LogController::class, "clear"])->name("log_clear");
        Route::post("clear-visitor-counter", [App\Http\Controllers\Admin\HomeController::class, "clearVisitorCounter"])->name("clearvisitorcounter");
    });
});
