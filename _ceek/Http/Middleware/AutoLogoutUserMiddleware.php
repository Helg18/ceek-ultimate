<?php

namespace Ceek\Http\Middleware;

use Auth;
use Closure;

class AutoLogoutUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
         Auth::logout();
         return $next($request);
     }
}
