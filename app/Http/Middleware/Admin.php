<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check())
            view()->composer(themeView("admin", "layout.header"), function ($view) {
                $messages = \App\Models\Message::unread()->get();
                $comments = \App\Models\BlogComment::pending()->get();
                $view->with(compact('messages', 'comments'));
            });
        return $next($request);
    }
}
