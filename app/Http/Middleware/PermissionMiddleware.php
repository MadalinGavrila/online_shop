<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if(!auth()->check()){
            abort(404);
        }

        if(!$request->user()->can($permission)){
            abort(404);
        }

        return $next($request);
    }
}
