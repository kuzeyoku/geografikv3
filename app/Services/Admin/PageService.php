<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Page;

class PageService extends BaseService

{
    public function __construct(Page $page)
    {
        parent::__construct($page, ModuleEnum::Page);
    }
}
