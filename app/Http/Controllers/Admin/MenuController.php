<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Menu;
use App\Services\Admin\MenuService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;

class MenuController extends Controller
{
    public function __construct(private readonly MenuService $service)
    {
        View::share([
            'route' => $service->route(),
            'folder' => $service->folder()
        ]);
    }

    public function index()
    {
        $data = $this->getData();
        $data["menu"] = null;
        return view(themeView("admin", "{$this->service->folder()}.index"), $data);
    }

    public function edit(Menu $menu)
    {
        $data = $this->getData($menu);
        $data["menu"] = $menu;
        return view(themeView("admin", "{$this->service->folder()}.index"), $data);
    }

    private function getData($menu = null)
    {
        $mdata = Menu::order()->get();
        $parents = $mdata->whereNotIn("id", [optional($menu)->id] ?: []);
        $data["menus"] = $mdata;
        $data["parents"] = $parents->pluck("title", "id");
        $data["urlList"] = $this->service->getUrlList();
        return $data;
    }

    public function store(StoreMenuRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        try {
            $this->service->update($request->validated(), $menu);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function destroy(Menu $menu)
    {
        try {
            $this->service->delete($menu);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Exception $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }
}
