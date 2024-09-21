<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ModuleEnum;
use Throwable;
use App\Models\Popup;
use Illuminate\Http\Request;
use App\Services\Admin\PopupService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Popup\StorePopupRequest;
use App\Http\Requests\Popup\UpdatePopupRequest;
use function PHPUnit\Framework\throwException;

class PopupController extends Controller
{

    public function __construct(private readonly PopupService $service)
    {
        View::share([
            "route" => $service->route(),
            "folder" => $service->folder(),
            "module" => ModuleEnum::Popup
        ]);
    }

    public function index()
    {
        $items = $this->service->getAll();
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
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->withInput()
                ->with("error", __("admin/alert.default_error"));
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
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->withInput()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Popup $popup)
    {
        try {
            $this->service->statusUpdate($request->validated(), $popup);
            return back()
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function destroy(Popup $popup)
    {
        try {
            $this->service->delete($popup);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }
}
