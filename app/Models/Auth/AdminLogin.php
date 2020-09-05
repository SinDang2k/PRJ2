<?php

namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class AdminLogin extends User
{
    use Notifiable;
    protected $table = 'admin';
    protected $guard = 'admin';
    protected $fillable = [
        'full_name',
        'email',
        'avatar',
        'phone',
        'address',
        'gender',
        'level'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
