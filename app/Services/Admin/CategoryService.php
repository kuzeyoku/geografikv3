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

    public function modulesToSelectArray(): array
    {
        return [
            ModuleEnum::Blog->value => ModuleEnum::Blog->title(),
            ModuleEnum::Service->value => ModuleEnum::Service->title(),
            ModuleEnum::Product->value => ModuleEnum::Product->title(),
            ModuleEnum::Project->value => ModuleEnum::Project->title(),
        ];
    }
}
