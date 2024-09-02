<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Page;
use App\Services\Admin\PageService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Page\StorePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;

class PageController extends Controller
{
    public function __construct(private PageService $service)
    {
        View::share([
            'route' => $service->route(),
            'folder' => $service->folder()
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

    public function store(StorePageRequest $request)
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

    public function edit(Page $page)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("page"));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        try {
            $this->service->update($request->validated(), $page);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Page $page)
    {
        try {
            $this->service->statusUpdate($request->validated(), $page);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Page $page)
    {
        try {
            $this->service->delete($page);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }
}
