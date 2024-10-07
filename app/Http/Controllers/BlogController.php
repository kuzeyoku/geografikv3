<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Http\Requests\Blog\CommentRequest;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Services\CacheService;
use App\Services\Front\SeoService;
use App\Services\ValidationService;

class BlogController extends Controller
{
    public function index()
    {
        SeoService::module(ModuleEnum::Blog);
        $cacheKey = ModuleEnum::Blog->value . "_index";
        $data = CacheService::cacheQuery($cacheKey, fn() => $this->getBlogData());
        return view(ModuleEnum::Blog->folder() . ".index", $data);
    }

    public function show(Blog $blog)
    {
        SeoService::show($blog);
        $blog->increment("view_count");
        $cacheKey = ModuleEnum::Blog->value . "_" . $blog->id . "_detail";
        $data = CacheService::cacheQuery($cacheKey, fn() => $this->getBlogDetailData($blog));
        return view(ModuleEnum::Blog->folder() . ".show", $data);
    }

    public function comment_store(CommentRequest $request, Blog $blog)
    {
        try {
            ValidationService::checkRecaptcha($request->validated());
            $this->ipControl($request->ip());
        } catch (\Exception $e) {
            return back()->withInput()->with("error", $e->getMessage());
        }
        try {
            $blog->comments()->create($request->validated());
            return back()->with("success", __("front/blog.comment_success"));
        } catch (\Exception $e) {
            return back()->withInput()->with("error", __("front/blog.comment_error"));
        }
    }

    private function ipControl($ip)
    {
        $comment = BlogComment::whereIp($ip)->latest()->first();
        if ($comment) {
            if ($comment->created_at->diffInMinutes(\Carbon\Carbon::now()) < 15)
                throw new \Exception(__("front/blog.comment_ip_block"));
        }
    }

    private function getBlogData()
    {
        return [
            "blogs" => Blog::active()->order()->paginate(setting("pagination", "front", 10)),
            "popularPosts" => Blog::active()->viewOrder()->take(5)->get(),
            "categories" => Category::whereModule(ModuleEnum::Blog)->active()->get(),
        ];
    }

    public function getBlogDetailData(Blog $blog)
    {
        return [
            "blog" => $blog,
            "popularPosts" => Blog::active()->viewOrder()->take(5)->get(),
            "categories" => Category::active()->whereModule(ModuleEnum::Blog->value)->get(),
            "comments" => $blog->comments()->approved()->paginate(5),
        ];
    }
}
