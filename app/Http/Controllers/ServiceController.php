<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Services\Front\SeoService;

class ServiceController extends Controller
{
    public function index()
    {
        SeoService::set();
        $services = Service::active()->order()->get();
        return view("service.index", compact("services"));
    }

    public function category(Category $category)
    {
        SeoService::set($category);
        $services = Service::active()->order()->whereBelongsTo($category)->get();
        return view("service.index", compact("category", "services"));
    }

    public function show(Service $service)
    {
        SeoService::set($service);
        $otherServices = Service::whereKeyNot($service->id)->get();
        return view("service.show", compact("service", "otherServices"));
    }

}
