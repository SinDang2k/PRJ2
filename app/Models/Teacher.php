<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';

    protected $fillable = [
    	'images',
    	'teacher_name',
    	'birthday',
    	'phone',
    	'address',
    	'gender',
    	'email',
        'password',
        'status'
    ];

    public $timestamps = false;
}
