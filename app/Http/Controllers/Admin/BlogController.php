<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Services\Admin\BlogService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Requests\GeneralStatusRequest;

class BlogController extends Controller
{
    public function __construct(private BlogService $service)
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
        return view(themeView("admin", "{$this->service->folder()}.index"), compact("items"));
    }

    public function create()
    {
        return view(themeView("admin", "{$this->service->folder()}.create"));
    }

    public function store(StoreBlogRequest $request)
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

    public function edit(Blog $blog)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact("blog"));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        try {
            $this->service->update($request->validated(), $blog);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Blog $blog)
    {
        try {
            $this->service->statusUpdate($request->validated(), $blog);
            return back()
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            $this->service->delete($blog);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withError(__("admin/alert.default_error"));
        }
    }

    public function comment(Blog $blog)
    {
        $items = $blog->comments()->paginate(config("pagination.admin", 15));
        return view(themeView("admin", "{$this->service->folder()}.comment"), compact("items"));
    }

    public function comments()
    {
        $items = BlogComment::paginate(config("pagination.admin", 15));
        return view(themeView("admin", "{$this->service->folder()}.comment"), compact("items"));
    }

    public function commentStatusChange(GeneralStatusRequest $request, BlogComment $comment)
    {
        try {
            $comment->update($request->validated());
            return back()->withSuccess(__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()->withError(__("admin/alert.default_error"));
        }
    }

    public function comment_delete(BlogComment $comment)
    {
        try {
            $comment->delete();
            return back()->withSuccess(__("admin/alert.default_success"));
        } catch (\Exception $e) {
            return back()->withError(__("admin/alert.default_error"));
        }
    }
}
