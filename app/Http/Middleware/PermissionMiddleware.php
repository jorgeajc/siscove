<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class PermissionMiddleware
{ 
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guest()) {
            return view('avisos');
        }
     
        if (! $request->user()->can($permission)) {
           abort(403);
        }
        return $next($request);
    }
}
