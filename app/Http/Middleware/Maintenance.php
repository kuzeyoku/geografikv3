<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Maintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        if (setting("maintenance", "status") == StatusEnum::Active->value && !Auth::check()) {
            return redirect()->route("maintenance");
        } else {
            return $next($request);
        }
    }
}
