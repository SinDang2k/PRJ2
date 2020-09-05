<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckTeacherSession
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
        if (!Session::has('teacher_id')) {
            return $next($request);
        } else if (Session::has('admin_id')) {
            return redirect()->back(); // đoạn này nếu admin nhập nhầm vào đường dẫn của teacher thì quay lại trang cũ
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }
}
