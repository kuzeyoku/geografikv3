<?php

namespace App\Http\Controllers\Admin;

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

    public function __construct(private ProductService $service)
    {
        View::share([
            "categories" => $service->getCategories(),
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
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
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
        if ($this->service->imageUpload($request, $product)) {
            return (object) [
                "message" => __("admin/alert.default_success")
            ];
        } else {
            return (object) [
                "message" => __("admin/alert.default_error")
            ];
        }
    }

    public function imageDelete(Media $image)
    {
        try {
            $this->service->imageDelete($image);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function imageAllDelete(Product $product)
    {
        try {
            $this->service->imageAllDelete($product);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->service->update($request->validated(), $product);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Product $product)
    {
        try {
            $this->service->statusUpdate($request->validated(), $product);
            return back();
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Product $product)
    {
        try {
            $this->service->delete($product);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }
}
