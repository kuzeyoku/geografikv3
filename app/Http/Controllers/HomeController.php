<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Slider;
use App\Models\Product;
use App\Services\SeoService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        SeoService::set();
        $data["slider"] = Cache::remember("slider_home_" . app()->getLocale(), config("cache.time"), function () {
            return Slider::active()->order()->get();
        });

        $data["product"] = Cache::remember("product_home_" . app()->getLocale(), config("cache.time"), function () {
            $product = Product::active()->order()->get();
            return $product->whereIn("category_id", [2, 3]);
        });

        $data["blog"] = Cache::remember("blog_home_" . app()->getLocale(), config("cache.time"), function () {
            return Blog::active()->order()->limit(3)->get();
        });
        return view("index", $data);
    }
}
