<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Category;
use App\Models\Product;
use App\Services\Front\SeoService;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

    public function index()
    {
        SeoService::module(ModuleEnum::Product);
        $categories = Cache::remember('categories', config("cache.time"), function () {
            return Category::module(ModuleEnum::Product)->active()->order()->get();
        });
        return view('product.index', compact("categories"));
    }

    public function category(Category $category)
    {
        SeoService::category($category);
        $products = Cache::remember('products_' . $category->id, config("cache.time"), function () use ($category) {
            return $category->products()->active()->order()->get();
        });
        return view('product.category', compact("products", "category"));
    }

    public function show(Product $product)
    {
        SeoService::show($product);
        return view('product.show', compact('product'));
    }
}
