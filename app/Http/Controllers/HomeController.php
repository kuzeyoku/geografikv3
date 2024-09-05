<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Enums\ModuleEnum;
use App\Models\Project;
use App\Models\Testimonial;
use App\Services\SeoService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        SeoService::set();
        $data["brand"] = Cache::remember("brand_home_" . app()->getLocale(), config("cache.time"), function () {
            return Brand::active()->order()->get();
        });

        $data["slider"] = Cache::remember("slider_home_" . app()->getLocale(), config("cache.time"), function () {
            return Slider::active()->order()->get();
        });

        $data["product"] = Cache::remember("product_home_" . app()->getLocale(), config("cache.time"), function () {
            $product = Product::active()->order()->get();
            return $product->whereIn("category_id", [2, 3]);
        });

        $data["project"] = Cache::remember("project_home_" . app()->getLocale(), config("cache.time"), function () {
            return Project::active()->order()->limit(6)->get();
        });

        $data["testimonial"] = Cache::remember("testimonial_home_" . app()->getLocale(), config("cache.time"), function () {
            return Testimonial::active()->order()->get();
        });

        $data["blog"] = Cache::remember("blog_home_" . app()->getLocale(), config("cache.time"), function () {
            return Blog::active()->order()->limit(3)->get();
        });

        $data["service_category"] = Cache::remember("service_category_home_" . app()->getLocale(), config("cache.time"), function () {
            return Category::active()->module(ModuleEnum::Service->value)->order()->get();
        });
        return view("index", $data);
    }
}
