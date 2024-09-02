<?php

namespace App\Services\Admin;

use App\Models\Brand;
use App\Enums\ModuleEnum;

class BrandService extends BaseService
{

    public function __construct(Brand $brand)
    {
        parent::__construct($brand, ModuleEnum::Brand);
    }
}
