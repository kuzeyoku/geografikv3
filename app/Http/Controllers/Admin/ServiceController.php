<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Service;
use App\Enums\ModuleEnum;
use Illuminate\Support\Facades\View;
use App\Services\Admin\ServiceService;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;

class ServiceController extends Controller
{

    public function __construct(private ServiceService $service)
    {
        View::share([
            "categories" => $service->getCategories(ModuleEnum::Service),
            "route" => $service->route(),
            "folder" => $service->folder(),
            "module" => $service->module()
        ]);
    }

    public function index()
    {
        $items = $this->service->all();
        return view(themeView("admin", "{$this->service->folder()}.index"), compact('items'));
    }

    public function create()
    {
        return view(themeView("admin", "{$this->service->folder()}.create"));
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function edit(Service $service)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        try {
            $this->service->update($request->validated(), $service);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Service $service)
    {
        try {
            $this->service->statusUpdate($request->validated(), $service);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Service $service)
    {
        try {
            $this->service->delete($service);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }
}
