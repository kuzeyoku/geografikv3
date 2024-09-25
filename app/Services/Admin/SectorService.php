<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Sector;

class SectorService extends BaseService
{
    public function __construct(Sector $sector)
    {
        parent::__construct($sector, ModuleEnum::Sector);
    }
}
