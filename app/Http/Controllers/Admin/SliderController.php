<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Slider;
use Illuminate\Support\Facades\View;
use App\Services\Admin\SliderService;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;

class SliderController extends Controller
{

    public function __construct(private SliderService $service)
    {
        View::share([
            "route" => $service->route(),
            "folder" => $service->folder(),
            "module" => $service->module()
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

    public function store(StoreSliderRequest $request)
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

    public function edit(Slider $slider)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("slider"));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        try {
            $this->service->update($request->validated(), $slider);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Slider $slider)
    {
        try {
            $this->service->statusUpdate($request->validated(), $slider);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Slider $slider)
    {
        try {
            $this->service->delete($slider);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }
}
