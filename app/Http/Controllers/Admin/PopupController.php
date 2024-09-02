<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Popup;
use Illuminate\Http\Request;
use App\Services\Admin\PopupService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Popup\StorePopupRequest;
use App\Http\Requests\Popup\UpdatePopupRequest;

class PopupController extends Controller
{

    public function __construct(private PopupService $service)
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
        return view(themeView("admin", "{$this->service->route()}.index"), compact("items"));
    }

    public function create()
    {
        return view(themeView("admin", "{$this->service->folder()}.create"));
    }

    public function store(StorePopupRequest $request)
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

    public function edit(Popup $popup)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("popup"));
    }

    public function update(UpdatePopupRequest $request, Popup $popup)
    {
        try {
            $this->service->update($request->validated(), $popup);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Popup $popup)
    {
        try {
            $this->service->statusUpdate($request->validated(), $popup);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Popup $popup)
    {
        try {
            $this->service->delete($popup);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }
}
