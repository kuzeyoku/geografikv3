<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SectorService;
use Illuminate\Support\Facades\View;

class SectorController extends Controller
{
    public function __construct(private readonly SectorService $service)
    {
        View::share([
            'route' => $service->route(),
            'folder' => $service->folder(),
        ]);
    }

    public function index()
    {
        return view('admin.sector.index');
    }

    public function create()
    {
        return view('admin.sector.create');
    }
}
