<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Department;
use App\Models\SubjectTeacher;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AssignmentController extends Controller
{
    public function view_all(Request $request)
    {

        if ($request->ajax()) {
            $assignments = DB::table('assignment')
            ->selectRaw("concat(prefix,classes_name,'K',course_name) as classes_name, teacher_name, subject_name,classes_id
                ")
            ->join('teacher', 'assignment.teacher_id', '=', 'teacher.id')
            ->join('subject', 'assignment.subject_id', '=', 'subject.id')
            ->join('classes', 'assignment.classes_id', '=', 'classes.id')
            ->join('department', 'classes.department_id', '=', 'department.id')
            ->join('course', 'classes.course_id', '=', 'course.id')
            ->get();

            return DataTables::of($assignments)
            ->addIndexColumn()
            ->addColumn('action', function ($assignment) {
                return
                '
                <div class="dropdown" style="right:5px">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="flaticon-more-button-of-three-dots"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="' . route('assignment.view_update', $assignment->classes_id) . '"><i class="fas fa-cogs text-dark-pastel-green"></i>Sửa</a>
                </div>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('assignment.view_all');
    }

    public function view_insert()
    {
        $Course = Course::all();
        $Department = Department::all();
        $teachers = Teacher::get(['teacher_name', 'id', 'images']);
        return view('assignment.view_insert', ['courses' => $Course, 'departments' => $Department, 'teachers' => $teachers]);
    }

    public function get_subject(Request $request)
    {
        return SubjectTeacher::with('subject')->where('teacher_id', $request->teacher_id)->get();
    }

    public function get_class(Request $request)
    {
        $assignment = Assignment::where(['teacher_id' => $request->teacher_id, 'subject_id' => $request->subject_id])
        ->get();
        $arr = [];
        foreach ($assignment as  $value) {
            $arr[] = $value->classes_id;
        }
        $classes = Classes::query()
        ->with(['department'=>function($query) use($request){
            $query->where('id',$request->department_id)->select('id','prefix');
        }])
        ->with(['course'=>function($query) use($request){
            $query->where('id',$request->course_id)->select('id','course_name');
        }])
        ->whereNotIn('id', $arr)->get();

        foreach ($classes as $key=> $value) {
            if($value->department!='' && $value->course!='')
            {
                $value->class_name=$value->department->prefix.$value->classes_name.
                'K'.$value->course->course_name;
                unset($value->department,$value->course,$value->classes_name);
            }
            else{
                unset($classes[$key]);
            }
        }
        return $classes;
    }

    public function process_insert(Request $request)
    {
        if($request->isMethod("post")){
            foreach ($request->classes as $value) {
                try {
                    Assignment::insert([
                        'classes_id' => $value,
                        'teacher_id' => $request->teacher_id,
                        'subject_id' => $request->subject_id,
                    ]);

                } catch (\Throwable $th) {
                }
            }
            return redirect()->route('assignment.view_all')->with('success', 'Thêm lịch phân công thành công');
        }else
        return redirect()->route('assignment.view_all')->with('warning', 'Phương thức truyền vào không đúng');

    }

    public function view_update($id)
    {
        $classes  = Classes::get();
        $assignments = DB::table('assignment')
            ->where('classes_id', $id)
            ->selectRaw("classes_name, teacher_name, subject_name, classes_id, teacher_id, subject_id
                ")
            ->join('teacher', 'assignment.teacher_id', '=', 'teacher.id')
            ->join('subject', 'assignment.subject_id', '=', 'subject.id')
            ->join('classes', 'assignment.classes_id', '=', 'classes.id')
            ->join('department', 'classes.department_id', '=', 'department.id')
            ->join('course', 'classes.course_id', '=', 'course.id')
            ->get();

         // dd($assignments);;

        return view('assignment.view_update', [
            'classes'   => $classes,
            'assignments' => $assignments
        ]);
    }


    // Nó phụ thuộc khoá chính nên k update được
    // public function process_update(Request $request, $id)
    // {
    //     // $subject_id = $request->input('id');
    //     // dd($subject_id);
    //     // dd($request->all());
    //     $assignments = DB::table('assignment')->update([
    //         'classes_id' => $request->classes_id,
    //         'teacher_id' => $request->teacher_id,
    //         'subject_id' => $request->subject_id
    //     ]);
    // }
}
