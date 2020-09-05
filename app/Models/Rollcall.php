<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rollcall extends Model
{
    protected $table = 'rollcall';

    protected $fillable = [
        'classes_id',
        'teacher_id',
        'subject_id',
        'created_at',
        'updated_at',
    ];

    public function RollCallDetail()
    {
        return $this->hasMany('App\Models\RollcallDetail', 'rollcall_id', 'id');
    }

    public function getRollCall()
    {
        return $this::selectRaw("concat(prefix,classes_name,'K',course_name) as class_name,
        created_at as khoi_tao,updated_at as sua,teacher_name")
            ->join('classes', 'classes.id', '=', 'rollcall.classes_id')
            ->join('department', 'department_id', '=', 'department.id')
            ->join('course', 'course.id', '=', 'course_id')
            ->join('teacher', 'teacher_id', '=', 'teacher.id')
            ->orderBy('rollcall.id', 'desc')
            ->get();
    }
}
