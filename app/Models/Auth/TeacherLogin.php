<?php

namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class TeacherLogin extends User
{
    use Notifiable;
    protected $guard = 'teacher';
    protected $table = 'teacher';
    protected $fillable = [
        'images',
        'teacher_name',
        'birthday',
        'phone',
        'address',
        'gender',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
