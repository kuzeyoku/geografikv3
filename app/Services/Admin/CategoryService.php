<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Category;

class CategoryService extends BaseService
{
    public function __construct(Category $category)
    {
        parent::__construct($category, ModuleEnum::Category);
    }
}
