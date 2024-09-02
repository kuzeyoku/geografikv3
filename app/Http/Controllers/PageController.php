<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;


class PageController extends Controller
{
    public function show(Page $page)
    {
        SeoService::set($page);
        return view('page', compact('page'));
    }
}
