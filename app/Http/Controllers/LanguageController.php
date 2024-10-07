<?php

namespace App\Http\Controllers;

use App\Http\Requests\Language\SetLanguageRequest;

class LanguageController extends Controller
{
    public function set(SetLanguageRequest $request)
    {
        $request->validate([
            "locale" => "required|string|exists:languages,code",
        ]);
        session()->put("locale", $request->locale);
        return back();
    }
}
