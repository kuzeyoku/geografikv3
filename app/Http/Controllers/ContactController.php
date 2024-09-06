<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Slider;
use App\Services\Front\ContactService;
use App\Services\Front\SeoService;

class ContactController extends Controller
{

    public function index()
    {
        SeoService::set(["title" => __("front/contact.title")]);
        $slider = Slider::active()->order()->get();
        return view('contact', compact('slider'));
    }

    public function send(ContactRequest $request)
    {
        try {
            ContactService::sendMail($request);
            return back()
                ->withSuccess(__("front/contact.send_success"));
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withError($e->getMessage());
        }
    }
}
