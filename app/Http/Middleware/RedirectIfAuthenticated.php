<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        
            if (Auth::guard($guard)->check()) {

                if (Auth::user()->roles == 1) {
                    return redirect('admin/dashboard');
                } else if (Auth::user()->roles == 2) {
                    return redirect('picker/dashboard');
                } else if (Auth::user()->roles == 3) {
                    return redirect('packer/dashboard');
                } else {
                    return redirect('manager/dashboard');
                }
            }

        return $next($request);
    }
}
