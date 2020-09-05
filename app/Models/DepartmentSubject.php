<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentSubject extends Model
{
    protected $table = 'department_subject';

    public $timestamps = false;

    protected $fillable = [
        'department_id',
        'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
}
