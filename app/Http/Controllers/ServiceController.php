<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Category;
use App\Models\Service;
use App\Services\Front\SeoService;

class ServiceController extends Controller
{
    public function index()
    {
        SeoService::module(ModuleEnum::Service);
        $categories = Category::module(ModuleEnum::Service)->active()->order()->get();
        return view("service.index", compact("categories"));
    }

    public function category(Category $category)
    {
        SeoService::category($category);
        $services = Service::active()->order()->whereBelongsTo($category)->get();
        return view("service.index", compact("category", "services"));
    }

    public function show(Service $service)
    {
        SeoService::show($service);
        $otherServices = Service::whereKeyNot($service->id)->get();
        return view("service.show", compact("service", "otherServices"));
    }

}
