<?php

namespace App\Http\Controllers;

use App\Enums\ModuleEnum;
use App\Models\Project;
use App\Services\Front\SeoService;

class ProjectController extends Controller
{
    public function index()
    {
        SeoService::module(ModuleEnum::Project);
        $projects = Project::active()->order()->get();
        return view('project.index', compact('projects'));
    }

    public function show(Project $project)
    {
        SeoService::show($project);
        $otherProjects = Project::whereKeyNot($project->id)->get();
        return view('project.show', compact('project', "otherProjects"));
    }
}
