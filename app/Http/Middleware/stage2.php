<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class stage2
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
                if (!Auth::user()->stage2) {
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
