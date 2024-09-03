<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Category;
use App\Enums\ModuleEnum;
use Illuminate\Support\Facades\View;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\GeneralStatusRequest;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service)
    {
        View::share([
            "categories" => $this->service->getCategories(),
            "modules" => ModuleEnum::toSelectArray(),
            "module" => $this->service->module(),
            "route" => $this->service->route(),
            "folder" => $this->service->folder()
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

    public function store(StoreCategoryRequest $request)
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

    public function edit(Category $category)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $this->service->update($request->validated(), $category);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Category $category)
    {
        try {
            $this->service->statusUpdate($request->validated(), $category);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Category $category)
    {
        try {
            $this->service->delete($category);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }
}
