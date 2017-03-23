<?php namespace App\Http\Middleware;

use Closure;
use Request;

class DeviceIdRequired
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
        $deviceid = $request->header('deviceid');
        if ($deviceid !== null && $deviceid !== false)
        {
            return $next($request);
        }
        return abort(403, 'Invalid header');
    }
}
