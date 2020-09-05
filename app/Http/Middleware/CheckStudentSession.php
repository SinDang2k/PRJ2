<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckStudentSession
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
        if (!Auth::guard('admin')->check() || !Auth::guard('teacher')->check()) {
            return $next($request);
        } else if ($request->session()->has('student_id')) {
            return $next($request);
        } else {
            // không cần else vì nếu nhảy 1 vào 1 trong 2 cái dưới thì những đoạn dưới k chạy nữa;
            return redirect()->route('student.view_login');
        }
    }
}
