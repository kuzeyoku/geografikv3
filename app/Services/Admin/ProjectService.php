<?php

namespace App\Services\Admin;

use App\Models\Project;
use App\Enums\ModuleEnum;

class ProjectService extends BaseService
{
    public function __construct(Project $project)
    {
        parent::__construct($project, ModuleEnum::Project);
    }
}
