<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sector\StoreSectorRequest;
use App\Services\Admin\SectorService;
use Illuminate\Support\Facades\View;
use Throwable;

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
        $items = $this->service->getAll();
        return view(themeView("admin", "{$this->service->folder()}.index"), compact('items'));
    }

    public function create()
    {
        return view(themeView("admin", "{$this->service->folder()}.create"));
    }

    public function store(StoreSectorRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error", __("admin/alert.default_error"));
        }
    }
}
