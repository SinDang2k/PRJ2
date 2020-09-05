<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'classes_name',
        'department_id',
        'course_id'
    ];

    public $timestamps = false;

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function array_student()
    {
        return $this->hasMany('App\Models\Student', 'classes_id', 'id');
    }

    public function getFullNameClassAttribute()
    {
        return $this->department->prefix.$this->classes_name.'K'.$this->course->course_name;
    }
}
