<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Brand;
use App\Services\Admin\BrandService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Requests\GeneralStatusRequest;

class BrandController extends Controller
{
    public function __construct(private BrandService $service)
    {
        View::share([
            "route" => $service->route(),
            "folder" => $service->folder()
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

    public function store(StoreBrandRequest $request)
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

    public function edit(Brand $brand)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("brand"));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        try {
            $this->service->update($request->validated, $brand);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Brand $brand)
    {
        try {
            $this->service->statusUpdate($request->validated(), $brand);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Brand $brand)
    {
        try {
            $this->service->delete($brand);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }
}
