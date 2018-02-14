<?php

namespace App\Http\Middleware;

use Closure;

class ultraadmin
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
        if ( \Auth::guard('superadmin')->user()->status == 1 ){
            return $next($request);
        }elseif(\Auth::user()){
            return redirect()->back();
        }
        return redirect()->guest('/admin');
    }
}
