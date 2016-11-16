<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class stage1
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

        if(Auth::user()) {
            if (!Auth::user()->is_admin) {
                if (!Auth::user()->stage1) {
                    return redirect('/');
                }
            }
        }else{
            return redirect('/login');
        }

        return $next($request);
    }
}
