<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\SeoService;

class ProjectController extends Controller
{
    public function index()
    {
        SeoService::set();
        $projects = Project::active()->order()->get();
        return view('project.index', compact('projects'));
    }

    public function show(Project $project)
    {
        SeoService::set($project);
        $otherProjects = Project::whereKeyNot($project->id)->get();
        return view('project.show', compact('project', "otherProjects"));
    }
}
