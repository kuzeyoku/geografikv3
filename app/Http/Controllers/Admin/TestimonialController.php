<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Testimonial;
use Illuminate\Support\Facades\View;
use App\Services\Admin\TestimonialService;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;

class TestimonialController extends Controller
{

    public function __construct(private readonly TestimonialService $service)
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

    public function store(StoreTestimonialRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function edit(Testimonial $testimonial)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("testimonial"));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        try {
            $this->service->update($request->validated(), $testimonial);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Testimonial $testimonial)
    {
        try {
            $this->service->statusUpdate($request->validated(), $testimonial);
            return back()
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        try {
            $this->service->delete($testimonial);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }
}
