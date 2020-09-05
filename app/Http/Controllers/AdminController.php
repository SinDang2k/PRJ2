<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController
{
    public function getLogin()
    {
        $title = 'Đăng nhập Admin';
        return view('admin.login', [
            'title' => $title
        ]);
    }

    public function postLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->get('remember'))) {
            return redirect()->route('dashboard');
        } else
            return redirect()->route('admin.getLogin')->with('error', 'Lỗi đăng nhập');
    }

    public function getLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.getLogin');
    }
}
