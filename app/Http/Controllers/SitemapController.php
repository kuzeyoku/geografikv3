<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;

class SitemapController extends Controller
{
    public function index()
    {
        $data = array();
        if (config("module.page.status"))
            $data["pages"] = Page::active()->get();
        if (config("module.blog.status"))
            $data["posts"] = Blog::active()->get();
        if (config("module.category.status"))
            $data["categories"] = Category::active()->get();
        if (config("module.service.status"))
            $data["services"] = Service::active()->get();
        if (config("module.project.status"))
            $data["projects"] = Project::active()->get();
        if (config("module.product.status"))
            $data["products"] = Product::active()->get();
        $view = view("common.sitemap", $data)->render();
        return response($view)->header("Content-Type", "text/xml");
    }
}
