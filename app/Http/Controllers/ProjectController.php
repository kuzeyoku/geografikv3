<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Project;
use App\Services\Front\SeoService;
use App\Services\Front\SettingService;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function index()
    {
        SeoService::module(ModuleEnum::Project);
        $projects = SettingService::cacheIsActive()
            ? Cache::remember(ModuleEnum::Project->value . "_index_" . app()->getLocale(), config("cache.time"), fn() => Project::active()->order()->get())
            : Project::active()->order()->get();
        return view('project.index', compact('projects'));
    }

    public function show(Project $project)
    {
        SeoService::show($project);
        $otherProjects = SettingService::cacheIsActive()
            ? Cache::remember(ModuleEnum::Project->value . "_" . $project->id . "_other_" . "_" . app()->getLocale(), config("cache.time"), fn() => $project->category->projects()->active()->whereKeyNot($project)->order()->get())
            : $project->category->projects()->active()->whereKeyNot($project)->order()->get();
        return view('project.show', compact('project', "otherProjects"));
    }
}
