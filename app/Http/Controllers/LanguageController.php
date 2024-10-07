<?php

namespace App\Http\Controllers;

use App\Http\Requests\Language\SetLanguageRequest;

class LanguageController extends Controller
{
    public function set(SetLanguageRequest $request)
    {
        session()->put("locale", $request->get("locale"));
        return back();
    }
}
