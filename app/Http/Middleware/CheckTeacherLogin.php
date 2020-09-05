<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTeacherLogin
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
        if (Auth::guard('teacher')->check()) {
            if(Auth::guard('teacher')->user()->status==1)
            {
                return redirect()->route('teacher.getLogin');
            }
            return $next($request);
        } else {
            return redirect()->route('teacher.getLogin');
        }
    }
}