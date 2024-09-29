<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Category;
use App\Models\Service;
use App\Services\Front\SeoService;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    public function index()
    {
        SeoService::module(ModuleEnum::Service);
        $categories = Cache::remember("service_categories", config("cache.time"), function () {
            return Category::module(ModuleEnum::Service)->active()->order()->get();
        });
        return view("service.index", compact("categories"));
    }

    public function category(Category $category)
    {
        SeoService::category($category);
        $services = Cache::remember("service_category_" . $category->id, config("cache.time"), function () use ($category) {
            return $category->services()->active()->order()->get();
        });
        return view("service.category", compact("category", "services"));
    }

    public function show(Service $service)
    {
        SeoService::show($service);
        $otherServices = Cache::remember("service_other_" . $service->id, config("cache.time"), function () use ($service) {
            return $service->category->services()->active()->whereNot("id", $service->id)->order()->get();
        });
        return view("service.show", compact("service", "otherServices"));
    }
}
