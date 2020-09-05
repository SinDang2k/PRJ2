<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckSession
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
        if (!Auth::guard('admin')->check()) {
            return $next($request);
        } else if (Auth::guard('teacher')->check()) {
            // return redirect()->route('dashboard');
            return $next($request);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
