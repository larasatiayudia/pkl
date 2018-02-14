<?php

namespace App\Http\Middleware;

use Closure;

class superadmin
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
        if (\Auth::guard('superadmin')->user()->status == 0 ){
            return $next($request);
        }
        return redirect()->guest('/operator');
    }
}
