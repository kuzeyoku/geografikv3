<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Front\SeoService;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        SeoService::set($product);
        return view('product.show', compact('product'));
    }
}
