<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Category;
use App\Models\Product;
use App\Services\Front\SeoService;

class ProductController extends Controller
{

    public function index()
    {
        SeoService::module(ModuleEnum::Product);
        $categories = Category::where("module", ModuleEnum::Product)->active()->get();
        return view('product.index', compact("categories"));
    }

    public function category(Category $category)
    {
        SeoService::category($category);
        $products = $category->products()->get();
        return view('product.category', compact("products", "category"));
    }

    public function show(Product $product)
    {
        SeoService::show($product);
        return view('product.show', compact('product'));
    }
}
