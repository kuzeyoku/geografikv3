<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Category;
use App\Models\Product;
use App\Services\CacheService;
use App\Services\Front\SettingService;
use App\Services\Front\SeoService;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

    public function index()
    {
        SeoService::module(ModuleEnum::Product);
        $cacheKey = ModuleEnum::Product->value . "_index";
        $categories = CacheService::cacheQuery($cacheKey, fn() => Category::module(ModuleEnum::Product)->active()->order()->get());
        return view('product.index', compact("categories"));
    }

    public function category(Category $category)
    {
        SeoService::category($category);
        $cacheKey = ModuleEnum::Product->value . "_" . $category->id;
        $products = CacheService::cacheQuery($cacheKey, fn() => $category->products()->active()->order()->get());
        return view('product.category', compact("products", "category"));
    }

    public function show(Product $product)
    {
        SeoService::show($product);
        $cacheKey = ModuleEnum::Product->value . "_" . $product->id . "_other";
        $otherProducts = CacheService::cacheQuery($cacheKey, fn() => $product->category->products()->active()->whereKeyNot($product)->order()->get());
        return view('product.show', compact('product', 'otherProducts'));
    }
}
