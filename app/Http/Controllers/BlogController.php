<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\CommentRequest;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Services\Front\SeoService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{

    public function index()
    {
        SeoService::set(["title" => __("front/blog.meta_title"), "description" => __("front/blog.meta_description")]);
        if (config("cache.status") == StatusEnum::Active->value) {
            $cacheKey = ModuleEnum::Blog->value . "_list_" . (Paginator::resolveCurrentPage() ?: 1) . "_" . app()->getLocale();
            $data = Cache::remember($cacheKey, config("cache.time", 3600), function () {
                return [
                    "posts" => Blog::active()->order()->paginate(config("pagination.front", 10)),
                    "popularPost" => Blog::active()->viewOrder()->take(5)->get(),
                    "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
                ];
            });
        } else {
            $data = [
                "posts" => Blog::active()->order()->paginate(config("pagination.front", 10))->onEachSide(1),
                "popularPost" => Blog::active()->viewOrder()->take(5)->get(),
                "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
            ];
        }
        return view(ModuleEnum::Blog->folder() . ".index", $data);
    }

    public function show(Blog $blog)
    {
        SeoService::set($blog);
        $cacheKey = ModuleEnum::Blog->value . "_detail_" . $blog->id . "_" . app()->getLocale();
        $blog->increment("view_count");
        if (config("cache.status") == StatusEnum::Active->value) {
            $data = Cache::remember($cacheKey, config("cache.time", 3600), function () use ($blog) {
                return [
                    "blog" => $blog,
                    "popularPost" => Blog::active()->viewOrder()->take(5)->get(),
                    "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
                    "comments" => $blog->comments()->approved()->paginate(5),
                ];
            });
        } else {
            $data = [
                "blog" => $blog,
                "popularPost" => Blog::active()->viewOrder()->take(5)->get(),
                "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
                "comments" => $blog->comments()->approved()->paginate(5),
            ];
        }
        return view(ModuleEnum::Blog->folder() . ".show", $data);
    }

    public function comment_store(CommentRequest $request, Blog $blog)
    {
        if (!recaptcha($request))
            return back()->withError(__("front/general.recaptcha_error"));
        if (!$this->ipControl($request))
            return back()->withError(__("front/blog.comment_ip_block"));
        try {
            $blog->comments()->create($request->validated());
            return back()->withSuccess(__("front/blog.comment_success"));
        } catch (\Exception $e) {
            return back()->withInput()->withError(__("front/blog.comment_error"));
        }
    }

    private function ipControl(CommentRequest $request)
    {
        $data = BlogComment::whereIp($request->ip())->orderBy("created_at", "DESC")->first();
        if ($data) {
            if ($data->created_at->diffInMinutes(\Carbon\Carbon::now()) < 15)
                return false;
        }
        return true;
    }
}
