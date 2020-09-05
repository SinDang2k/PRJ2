<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    protected $table='forgot_password';

    protected $fillable=[
        'id_person',
        'position',
        'token',
        'timeout',
        'limitt',
        'status'
    ];

    public $timestamps=false;
}
