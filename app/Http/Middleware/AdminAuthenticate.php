<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuthenticate
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
        $url = explode('/', url()->previous());

        if(!Auth::guard('admin')->check())
        {
            if (in_array('admin', $url))
                return redirect()->route('admin.login');
            else    
                return redirect()->route('login');
        }

        return $next($request);
    }
}
