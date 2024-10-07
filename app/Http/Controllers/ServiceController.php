<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Category;
use App\Models\Service;
use App\Services\CacheService;
use App\Services\Front\SeoService;

class ServiceController extends Controller
{
    public function index()
    {
        SeoService::module(ModuleEnum::Service);
        $cacheKey = ModuleEnum::Service->value . "_index";
        $categories = CacheService::cacheQuery($cacheKey, fn() => Category::module(ModuleEnum::Service)->active()->order()->get());
        return view("service.index", compact("categories"));
    }

    public function category(Category $category)
    {
        SeoService::category($category);
        $cacheKey = ModuleEnum::Service->value . "_" . $category->id;
        $services = CacheService::cacheQuery($cacheKey, fn() => $category->services()->active()->order()->get());
        return view("service.category", compact("category", "services"));
    }

    public function show(Service $service)
    {
        SeoService::show($service);
        $cacheKey = ModuleEnum::Service->value . "_" . $service->id . "_other";
        $otherServices = CacheService::cacheQuery($cacheKey, fn() => $service->category->services()->active()->whereKeyNot($service)->order()->get());
        return view("service.show", compact("service", "otherServices"));
    }
}
