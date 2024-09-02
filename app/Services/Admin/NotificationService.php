<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;

class NotificationService
{
    protected $module;

    public function __construct(ModuleEnum $module)
    {
        $this->module = $module;
    }

    public function alert(string $type, array $params = []): string
    {
        $params["module"] = $this->module->alertTitle();
        return __("admin/alert.{$type}", $params);
    }

    public function log(string $type, array $params = []): string
    {
        $params["module"] = $this->module->alertTitle();
        return __("admin/alert.{$type}_log", $params);
    }

    
}
