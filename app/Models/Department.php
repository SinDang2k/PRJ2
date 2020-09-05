<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable = [
        'prefix',
        'department_name'
    ];

    public $timestamps = false;

    public function array_classes()
    {
        return $this->hasMany('App\Models\Classes', 'department_id', 'id');
    }

    public function array_subject()
    {
        return $this->hasMany('App\Models\Subject', 'department_id', 'id');
    }

    
}
