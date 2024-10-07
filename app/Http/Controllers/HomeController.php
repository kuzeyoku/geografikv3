<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Page;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Services\CacheService;
use App\Services\Front\SettingService;
use App\Services\Front\SeoService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        SeoService::index();
        $data["brands"] = $this->getModuleData(ModuleEnum::Brand, Brand::class);
        $data["sliders"] = $this->getModuleData(ModuleEnum::Slider, Slider::class);
        $data["projects"] = $this->getModuleData(ModuleEnum::Project, Project::class, 6);
        $data["testimonials"] = $this->getModuleData(ModuleEnum::Testimonial, Testimonial::class);
        $data["blogs"] = $this->getModuleData(ModuleEnum::Blog, Blog::class, 3);
        $data["sectors"] = $this->getModuleData(ModuleEnum::Sector, Sector::class);
        $data["about"] = CacheService::cacheQuery("about_home", fn() => Page::find(SettingService::get("information", "about_page")));
        return view("index", $data);
    }

    private function getModuleData(ModuleEnum $module, $model, $limit = 0)
    {
        $query = $model::active()->order();
        if ($limit > 0) {
            $query->limit($limit);
        }
        return CacheService::cacheQuery($module->value . "_home", fn() => $query->get());
    }
}
