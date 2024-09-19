<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ModuleEnum;
use Throwable;
use App\Models\Reference;
use Illuminate\Support\Facades\View;
use App\Services\Admin\ReferenceService;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Reference\StoreReferenceRequest;
use App\Http\Requests\Reference\UpdateReferenceRequest;

class ReferenceController extends Controller
{
    public function __construct(private readonly ReferenceService $service)
    {
        View::share([
            'route' => $service->route(),
            'folder' => $service->folder(),
            "module" => ModuleEnum::Reference
        ]);
    }

    public function index()
    {
        $items = $this->service->all();
        return view(themeView("admin", "{$this->service->folder()}.index"), compact("items"));
    }


    public function create()
    {
        return view(themeView("admin", "{$this->service->folder()}.create"));
    }

    public function store(StoreReferenceRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function edit(Reference $reference)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("reference"));
    }

    public function update(UpdateReferenceRequest $request, Reference $reference)
    {
        try {
            $this->service->update($request->validated(), $reference);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Reference $reference)
    {
        try {
            $this->service->statusUpdate($request->validated(), $reference);
            return back()
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function destroy(Reference $reference)
    {
        try {
            $this->service->delete($reference);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }
}
