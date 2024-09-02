<?php

namespace App\Services\Admin;

use App\Enums\ModuleEnum;
use App\Models\Testimonial;

class TestimonialService extends BaseService
{

    public function __construct(Testimonial $testimonial)
    {
        parent::__construct($testimonial, ModuleEnum::Testimonial);
    }
}
