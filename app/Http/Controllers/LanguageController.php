<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function set(Request $request)
    {
        $request->validate([
            "locale" => "required|string|exists:languages,code",
        ]);

        session()->put("locale", $request->locale);

        return back();
    }
}
