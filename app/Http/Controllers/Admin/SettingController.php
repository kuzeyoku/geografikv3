<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\Admin\SettingService;

class SettingController extends Controller
{
    public function __construct(private readonly SettingService $service)
    {

    }

    public function index($category = null)
    {
        $settings = $this->service->getCategory($category);
        return view(themeView("admin", "setting." . $category), compact("settings"));
    }

    public function update(Request $request)
    {
        try {
            $this->service->update($request);
            return back()
                ->with("success", __("admin/alert.default_success"));
        } catch (Throwable $e) {
            return back()
                ->with("error", __("admin/alert.default_error"));
        }
    }
}
