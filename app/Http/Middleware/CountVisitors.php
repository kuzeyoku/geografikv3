<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            Visitor::firstOrCreate(['ip_address' => $request->ip()])->increment("visit_count");
        } catch (Exception $e) {
            // do nothing
        }
        return $next($request);
    }
}
