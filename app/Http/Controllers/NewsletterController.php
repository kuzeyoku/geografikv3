<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\NewsletterRequest;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request)
    {
        if (!recaptcha($request)) {
            return back()
                ->withInput()
                ->withError(__("front/general.recaptcha_error"));
        }
        try {
            Newsletter::create(
                ["email" => $request->n_email]
            );
            return back()
                ->withSuccess(__("front/general.newsletter_success"));
        } catch (\Exception $e) {
            return back()
                ->withError(__("front/general.newsletter_error"));
        }
    }
}
