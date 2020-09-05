<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckStudentLogin
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
        if ($request->session()->has('student_id')) {
            return $next($request);
        } elseif (Auth::guard('teacher')->check()) {
            return redirect()->route('teacher.dashboard');
        } elseif(Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('student.view_login');
        }
    }
}
