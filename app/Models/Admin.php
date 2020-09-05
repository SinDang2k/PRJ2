<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $fillable = [
        'full_name',
        'phone',
        'address',
        'gender',
        'email',
        'password',
        'avatar',
        'token'
    ];

    public $timestamps = false;
}
