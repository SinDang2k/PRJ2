<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class view_login_student extends Model
{
    protected $table = 'view_login_student';
    protected $fillable = [
        'account',
        'student_name',
        'password'
    ];
    public $timestamps = false;
}
