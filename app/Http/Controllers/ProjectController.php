<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Project;
use App\Services\CacheService;
use App\Services\Front\SeoService;
use App\Services\Front\SettingService;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function index()
    {
        SeoService::module(ModuleEnum::Project);
        $cacheKey = ModuleEnum::Project->value . "_index";
        $projects = CacheService::cacheQuery($cacheKey, fn() => Project::active()->order()->get());
        return view('project.index', compact('projects'));
    }

    public function show(Project $project)
    {
        SeoService::show($project);
        $cacheKey = ModuleEnum::Product->value . "_" . $project->id . "_other";
        $otherProjects = CacheService::cacheQuery($cacheKey, fn() => Project::whereKeyNot($project->id)->active()->get());
        return view('project.show', compact('project', "otherProjects"));
    }
}
