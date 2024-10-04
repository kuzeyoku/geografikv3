<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Http\Requests\CommentRequest;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Services\Front\SeoService;
use App\Services\Front\SettingService;
use App\Services\ValidationService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{

    public function index()
    {
        SeoService::module(ModuleEnum::Blog);
        if (SettingService::cacheIsActive()) {
            $cacheKey = ModuleEnum::Blog->value . "_list_" . (Paginator::resolveCurrentPage() ?: 1) . "_" . app()->getLocale();
            $data = Cache::remember($cacheKey, config("cache.time"), function () {
                return [
                    "blogs" => Blog::active()->order()->paginate(setting("pagination", "front", 10)),
                    "popularPosts" => Blog::active()->viewOrder()->take(5)->get(),
                    "categories" => Category::whereModule(ModuleEnum::Blog)->active()->get(),
                ];
            });
        } else {
            $data = [
                "blogs" => Blog::active()->order()->paginate(setting("pagination", "front", 10))->onEachSide(1),
                "popularPosts" => Blog::active()->viewOrder()->take(5)->get(),
                "categories" => Category::active()->whereModule(ModuleEnum::Blog)->get(),
            ];
        }
        return view(ModuleEnum::Blog->folder() . ".index", $data);
    }

    public function show(Blog $blog)
    {
        SeoService::show($blog);
        $cacheKey = ModuleEnum::Blog->value . "_detail_" . $blog->id . "_" . app()->getLocale();
        $blog->increment("view_count");
        if (SettingService::cacheIsActive()) {
            $data = Cache::remember($cacheKey, config("cache.time"), function () use ($blog) {
                return [
                    "blog" => $blog,
                    "popularPosts" => Blog::active()->viewOrder()->take(5)->get(),
                    "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
                    "comments" => $blog->comments()->approved()->paginate(5),
                ];
            });
        } else {
            $data = [
                "blog" => $blog,
                "popularPosts" => Blog::active()->viewOrder()->take(5)->get(),
                "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
                "comments" => $blog->comments()->approved()->paginate(5),
            ];
        }
        return view(ModuleEnum::Blog->folder() . ".show", $data);
    }

    public function comment_store(CommentRequest $request, Blog $blog)
    {
        ValidationService::checkRecaptcha($request->validated());
        $this->ipControl($request);
        try {
            $blog->comments()->create($request->validated());
            return back()->with("success", __("front/blog.comment_success"));
        } catch (\Exception $e) {
            return back()->withInput()->with("error", __("front/blog.comment_error"));
        }
    }

    private function ipControl(CommentRequest $request)
    {
        $data = BlogComment::whereIp($request->ip())->orderBy("created_at", "DESC")->first();
        if ($data) {
            if ($data->created_at->diffInMinutes(\Carbon\Carbon::now()) < 15)
                throw new \Exception(__("front/blog.comment_ip_block"));
        }
    }
}
