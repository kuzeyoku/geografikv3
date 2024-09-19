<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Language;
use Illuminate\Support\Facades\View;
use App\Services\Admin\LanguageService;
use App\Http\Requests\GeneralStatusRequest;
use App\Http\Requests\Language\StoreLanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;

class LanguageController extends Controller
{

    public function __construct(private readonly LanguageService $service)
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

    public function store(StoreLanguageRequest $request)
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

    public function edit(Language $language)
    {
        return view(themeView("admin", "{$this->service->folder()}.edit"), compact('language'));
    }

    public function files(Language $language)
    {
        $response = $this->service->files($language);
        $frontFiles = $response['frontFiles'] ?? [];
        $adminFiles = $response['adminFiles'] ?? [];
        $fileContent = $response['fileContent'] ?? [];
        $filename = $response['filename'] ?? null;
        $dir = $response['folder'] ?? null;
        return view(themeView("admin", "{$this->service->folder()}.files"), compact('language', 'frontFiles', 'adminFiles', 'fileContent', 'filename', 'dir'));
    }

    public function updateFileContent(Language $language)
    {
        try {
            $this->service->updateFileContent($language);
            return back()->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()->with("error",__("admin/alert.default_error"));
        }
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
        try {
            $this->service->update($request->validated(), $language);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function statusUpdate(GeneralStatusRequest $request, Language $language)
    {
        try {
            $this->service->statusUpdate($request->validated(), $language);
            return back()
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }

    public function destroy(Language $language)
    {
        try {
            $this->service->delete($language);
            return redirect()
                ->route("admin.{$this->service->route()}.index")
                ->with("success",__("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error",__("admin/alert.default_error"));
        }
    }
}
