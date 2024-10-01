<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Services\Front\SeoService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        SeoService::index();
        $data["brands"] = Cache::remember("brand_home_" . app()->getLocale(), config("cache.time"), function () {
            return Brand::active()->order()->get();
        });

        $data["sliders"] = Cache::remember("slider_home_" . app()->getLocale(), config("cache.time"), function () {
            return Slider::active()->order()->get();
        });

        $data["projects"] = Cache::remember("project_home_" . app()->getLocale(), config("cache.time"), function () {
            return Project::active()->order()->limit(6)->get();
        });

        $data["testimonials"] = Cache::remember("testimonial_home_" . app()->getLocale(), config("cache.time"), function () {
            return Testimonial::active()->order()->get();
        });

        $data["blogs"] = Cache::remember("blog_home_" . app()->getLocale(), config("cache.time"), function () {
            return Blog::active()->order()->limit(3)->get();
        });

        $data["sectors"] = Cache::remember("sector_home_" . app()->getLocale(), config("cache.time"), function () {
            return Sector::active()->order()->get();
        });

        $data["about"] = Cache::remember("about_home_" . app()->getLocale(), config("cache.time"), function () {
            return Page::find(setting("information", "about"));
        });
        return view("index", $data);
    }
}
