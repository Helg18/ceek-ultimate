<?php namespace App\Http\Middleware;

use Auth;
use Closure;
use Request;
use Sellout\User;
use Sellout\Token;

class TokenAuthMiddleware {

    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        $deviceid = $request->header('deviceid');
        if($token === null || $deviceid === null)
        {
            return abort(403, 'Forbidden: Invalid header');
        }
        $tokenModel = new Token();
        $user = $tokenModel->resolveUser($token, $deviceid);
        if($user instanceof User)
        {
            Auth::login($user);
            return $next($request);
        }
        return abort(403, 'Login failed');
    }
}
