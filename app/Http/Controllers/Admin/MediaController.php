<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ModuleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function __construct()
    {
        View::share([
            "route" => ModuleEnum::Media->route(),
            "folder" => ModuleEnum::Media->folder(),
        ]);
    }

    public function index()
    {
        $items = Media::orderByDesc("id")->paginate(18);
        return view(themeView("admin", ModuleEnum::Media->folder() . ".index"), compact("items"));
    }

    public function destroy($media_id)
    {
        try {
            $media = Media::findOrFail($media_id);
            $media->delete();
            return back()->with("success",__("admin/" . ModuleEnum::Media->folder() . ".delete_success"));
        } catch (\Exception $e) {
            return back()->withErrors(__("admin/" . ModuleEnum::Media->folder() . ".delete_error"));
        }
    }
}
