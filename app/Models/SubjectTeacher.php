<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $table = 'subject_teacher';

    protected $fillable = [
        'subject_id',
        'teacher_id'
    ];

    public $timestamps = false;

    public function subject()
    {
        return $this->hasMany('App\Models\Subject', 'id', 'subject_id');
    }
}
