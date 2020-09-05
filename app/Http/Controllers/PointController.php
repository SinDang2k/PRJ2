<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\Course;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function view_insert()
    {
        $courses = Course::all();
        $departments = Department::all();
        $subjects  = Subject::all();

        return view('point.view_insert', [
            'subjects'  => $subjects,
            'courses'   => $courses,
            'departments' => $departments
        ]);
    }

    public function view_update()
    {
        $courses = Course::all();
        $departments = Department::all();
        $subjects  = Subject::all();

        return view('point.view_update', [
            'subjects'  => $subjects,
            'courses'   => $courses,
            'departments' => $departments
        ]);
    }

    public function get_student(Request $rq)
    {
        $classes_id = $rq->get('classes_id');
        $subject_id = $rq->get('subject_id');
        $students = Student::query()
        ->with(['points' => function($query) use ($subject_id){
            $query->where('subject_id', $subject_id)->select('point','type_exam');
        }])
        ->where('classes_id', $classes_id)
        ->get();

        return $students;
    }

    public function update(Request $rq)
    {
        $point = Point::where([
            'student_id' => $rq->student_id,
            'subject_id' => $rq->subject_id,
            'type_exam' => $rq->type,
        ])->update(['point' => $rq->point]);
        if ($point == 0) {
            try {
                $point = Point::insert([
                    'student_id' => $rq->student_id,
                    'subject_id' => $rq->subject_id,
                    'type_exam'  => $rq->type,
                    'point'      => $rq->point
                ]);
            } catch (\Throwable $th) {
            }
        }
    }

    public function get_class(Request $rq)
    {
        $point = Point::where(['subject_id' => $rq->subject_id])
            ->join('student', 'point.student_id', 'student.id')
            ->get();
        $arr = [];
        foreach ($point as $value) {
            $arr[] = $value->classes_id;
        }

        $classes = Classes::query()
        ->with(['department'=>function($query) use ($rq){
            $query->select('id','prefix')->where('id',$rq->department_id);
        }])
        ->with(['course'=>function($query) use ($rq){
            $query->select('id','course_name')->where('id', $rq->course_id);
        }])
        ->whereNotIn('id', $arr)->get();
        $arr=[];
        foreach ($classes as $value) {
            if($value->department!='' && $value->course!='')
            {
                $arr[]=(object)['id'=>$value->id,
                'class_name'=>$value->class_name=$value->department->prefix.$value->classes_name.
                'K'.$value->course->course_name];
            }
        }
        return $arr;
    }

    public function get_classs(Request $rq)
    {
        $point = Point::where(['subject_id' => $rq->subject_id])
            ->join('student', 'point.student_id', 'student.id')
            ->get();
        $arr = [];
        foreach ($point as $value) {
            $arr[] = $value->classes_id;
        }

        $classes = Classes::query()
        ->with(['department'=>function($query) use ($rq) {
            $query->select('id','prefix')->where('id',$rq->department_id);
        }])
        ->with(['course'=>function($query) use ($rq){
            $query->select('id','course_name')->where('id', $rq->course_id);
        }])
        ->whereIn('id', $arr)->get();
        $arr=[];
        foreach ($classes as $value) {
            if($value->department!='' && $value->course!='')
            {
                $arr[]=(object)['id'=>$value->id,
                'class_name'=>$value->class_name=$value->department->prefix.$value->classes_name.
                'K'.$value->course->course_name];
            }
        }
        return $arr;
    }
}
