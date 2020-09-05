<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $fillable = [
        'student_name',
        'email',
        'password',
        'birthday',
        'phone',
        'address',
        'gender',
        'classes_id'
    ];

    public $timestamps = false;

    public function classes()
    {
        return $this->belongsTo('App\Models\Classes', 'classes_id');
    }

    public function points()
    {
        return $this->belongsToMany('App\Models\Subject', 'point', 'student_id','subject_id')->using('App\Models\Point');
    }

    public function getGenderNameAttribute()
    {
        if ($this->gender == 1) {
            return 'Nam';
        } else {
            return "Nữ";
        }
    }
    public function getClassFullNameAttribute()
    {
        return $this->classes->department->prefix . $this->classes->classes_name . 'K' . $this->classes->course->course_name;
    }

    public function studentInfo()
    {
        return $this->selectRaw(" student.id as id,
            student_name,
            if(student.gender=1,'Nam','Nữ') as gender,
            concat(department.prefix,classes.classes_name,'K',course.course_name) as class_name,
            address,birthday,phone,email")
            ->join('classes', 'classes.id', '=', 'student.classes_id')
            ->join('department', 'department.id', '=', 'classes.department_id')
            ->join('course', 'course.id', '=', 'classes.course_id')
            ->get();
    }
}
