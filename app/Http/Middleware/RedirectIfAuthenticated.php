<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $url = explode('/', url()->previous());

        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    if (in_array('admin', $url))
                        return redirect()->route('admin.home');
                    else    
                        return redirect()->route('home');
                }
                break;
            
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                }
                break;
        }

        return $next($request);
    }
}
