<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignment';

    protected $fillable = [
        'classes_id',
        'teacher_id',
        'subject_id'
    ];

    public $timestamps = false;

    public function class()
    {
        return $this->belongsTo('App\Models\Classes', 'classes_id');
    }

    public function getFullClassNameAttribute()
    {
        return $this->class->department->prefix.$this->class->classes_name.'K'.$this->class->course->course_name;
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }
}
