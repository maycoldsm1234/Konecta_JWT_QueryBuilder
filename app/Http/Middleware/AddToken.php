<?php

namespace App\Http\Middleware;

use Closure;

class AddToken
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
		$token = isset($_COOKIE["jwt_token"])?$_COOKIE["jwt_token"]:"";
    	//$request['token'] = $token;//this is working
    	$request->headers->set("Authorization", "Bearer $token");//this is working
        return $next($request);
    }
}
