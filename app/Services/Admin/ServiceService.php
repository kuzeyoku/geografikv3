<?php

namespace App\Services\Admin;

use App\Models\Service;
use App\Enums\ModuleEnum;

class ServiceService extends BaseService
{
    public function __construct(Service $service)
    {
        parent::__construct($service, ModuleEnum::Service);
    }
}
