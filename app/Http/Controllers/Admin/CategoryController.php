<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\GeneralStatusRequest;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $service)
    {
        View::share([
            "categories" => $this->service->getCategories(),
            "modules" => $this->service->modulesToSelectArray(),
            "route" => $this->service->route(),
            "folder" => $this->service->folder()
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

    public function store(StoreCategoryRequest $request)
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
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->withInput()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Category $category)
    {
        try {
            $this->service->statusUpdate($request->validated(), $category);
            return back()
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function destroy(Category $category)
    {
        try {
            $this->service->delete($category);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }
}
