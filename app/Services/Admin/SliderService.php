<?php

namespace App\Services\Admin;

use App\Models\Slider;
use App\Enums\ModuleEnum;

class SliderService extends BaseService
{

    public function __construct(Slider $slider)
    {
        parent::__construct($slider, ModuleEnum::Slider);
    }
}
