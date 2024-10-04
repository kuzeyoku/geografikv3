<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ModuleEnum;
use App\Services\Admin\FileService;
use Throwable;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use App\Services\Admin\ProductService;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Product\ImageProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{

    public function __construct(private readonly ProductService $service)
    {
        View::share([
            "categories" => $service->getCategories(),
            "route" => $service->route(),
            "folder" => $service->folder(),
            "module" => ModuleEnum::Product
        ]);
    }

    public function index()
    {
        $items = $this->service->getAll();
        return view(themeView("admin", "{$this->service->folder()}.index"), compact('items'));
    }

    public function show(Product $product)
    {
        return view(themeView("admin", "{$this->service->folder()}.show"), compact('product'));
    }

    public function create()
    {
        return view(themeView("admin", "{$this->service->folder()}.create"));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function edit(Product $product)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("product"));
    }

    public function image(Product $product)
    {
        return view(themeView("admin", "layout.image"), ["item" => $product]);
    }

    public function imageStore(ImageProductRequest $request, Product $product): object
    {
        try {
            $fileService = new FileService("file", $request->validated(), "images");
            $fileService->upload($product, $request->validated());
            return (object)[
                "status" => "success",
                "message" => __("admin/alert.default_success")
            ];
        } catch (Throwable $e) {
            return (object)[
                "status" => "error",
                "message" => __("admin/alert.default_error")
            ];
        }
    }

    public function imageDelete(Media $image)
    {
        try {
            $this->service->imageDelete($image);
            return back()
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function imageAllDelete(Product $product)
    {
        try {
            $this->service->imageAllDelete($product);
            return back()
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->service->update($request->validated(), $product);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Product $product)
    {
        try {
            $this->service->statusUpdate($request->validated(), $product);
            return back();
        } catch (Throwable $e) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }

    public function destroy(Product $product)
    {
        try {
            $this->service->delete($product);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }
}
