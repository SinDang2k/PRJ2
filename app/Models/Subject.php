<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';

    protected $fillable = [
        'subject_name',
        'sessions'
    ];

    public $timestamps = false;

    public function subject_department()
    {
        return $this->hasMany('App\Models\DepartmentSubject', 'subject_id', 'id');
    }

    public function array_point()
    {
        return $this->hasMany('App\Models\Point', 'subject_id', 'id');
    }
}
