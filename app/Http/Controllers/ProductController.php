<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Category;
use App\Models\Product;
use App\Services\Front\SettingService;
use App\Services\Front\SeoService;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

    public function index()
    {
        SeoService::module(ModuleEnum::Product);
        $categories = SettingService::cacheIsActive()
            ? Cache::remember(ModuleEnum::Product->value . "_index_" . app()->getLocale(), config("cache.time"), fn() => Category::module(ModuleEnum::Product)->active()->order()->get())
            : Category::module(ModuleEnum::Product)->active()->order()->get();
        return view('product.index', compact("categories"));
    }

    public function category(Category $category)
    {
        SeoService::category($category);
        $products = SettingService::cacheIsActive()
            ? Cache::remember(ModuleEnum::Product->value . "_" . $category->id . "_" . app()->getLocale(), config("cache.time"), fn() => $category->products()->active()->order()->get())
            : $category->products()->active()->order()->get();
        return view('product.category', compact("products", "category"));
    }

    public function show(Product $product)
    {
        SeoService::show($product);
        $otherProducts = SettingService::cacheIsActive()
            ? Cache::remember(ModuleEnum::Product->value . "_" . $product->id . "_other_" . "_" . app()->getLocale(), config("cache.time"), fn() => $product->category->products()->active()->whereKeyNot($product)->order()->get())
            : $product->category->products()->active()->whereKeyNot($product->id)->order()->get();
        return view('product.show', compact('product', 'otherProducts'));
    }
}
