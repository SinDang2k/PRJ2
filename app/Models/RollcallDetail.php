<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RollcallDetail extends Model
{
    protected $table = 'rollcall_detail';

    protected $fillable = [
        'rollcall_id',
        'student_id',
        'status',
    ];

    public $timestamps = false;

    public function getStatusAndInfoStudent($arr)
    {
        return $this::selectRaw('student.id,student_name,birthday,status')
            ->join('student', 'rollcall_detail.student_id', '=', 'student.id')
            ->whereIn('rollcall_id', $arr)
            ->get();
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
