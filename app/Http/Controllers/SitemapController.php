<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use App\Services\CacheService;

class SitemapController extends Controller
{
    public function index()
    {
        $data = array();
        if (config("module.page.status"))
            $data["pages"] = CacheService::cacheQuery("sitemap_pages", fn() => Page::active()->get());
        if (config("module.blog.status"))
            $data["posts"] = CacheService::cacheQuery("sitemap_posts", fn() => Blog::active()->get());
        if (config("module.category.status"))
            $data["categories"] = CacheService::cacheQuery("sitemap_categories", fn() => Category::active()->get());
        if (config("module.service.status"))
            $data["services"] = CacheService::cacheQuery("sitemap_services", fn() => Service::active()->get());
        if (config("module.project.status"))
            $data["projects"] = CacheService::cacheQuery("sitemap_projects", fn() => Project::active()->get());
        if (config("module.product.status"))
            $data["products"] = CacheService::cacheQuery("sitemap_products", fn() => Product::active()->get());
        $view = view("common.sitemap", $data)->render();
        return response($view)->header("Content-Type", "text/xml");
    }
}
