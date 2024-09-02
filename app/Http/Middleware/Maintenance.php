<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config("maintenance.status", StatusEnum::Passive->value) == StatusEnum::Active->value && !Auth::check()) {
            return redirect()->route("maintenance");
        } else {
            return $next($request);
        }
    }
}
