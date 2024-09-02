<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\EditorRequest;

class EditorController extends Controller
{

    public function store(EditorRequest $request)
    {
        if ($request->hasFile("file") && $request->file("file")->isValid()) {
            $user = User::find(auth()->id());
            $upload = $user->addMediaFromRequest("file")->usingFileName(Str::random(8) . "." . $request->file("file")->extension())->toMediaCollection("editor");
            return response()->json([
                "location" => $upload->getUrl()
            ]);
        }
        return [
            "error" => [
                "message" => "Dosya yüklenirken bir hata oluştu."
            ]
        ];
    }
}
