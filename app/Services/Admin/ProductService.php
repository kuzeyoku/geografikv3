<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Enums\ModuleEnum;

class ProductService extends BaseService
{
    public function __construct(Product $product)
    {
        parent::__construct($product, ModuleEnum::Product);
    }
}
