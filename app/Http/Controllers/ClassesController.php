<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Department;
use DataTables;
use Alert;

class ClassesController extends Controller
{
    public function view_all(Request $rq)
    {
        if ($rq->ajax()) {
            $classes = Classes::query()
            ->with(['department'=>function($query){
                $query->select('*');
            }])
            ->with(['course'=>function($query){
                $query->select('*');
            }])
            ->get();
            foreach ($classes as $value) {
                $value->class_name=$value->department->prefix.$value->classes_name.
                'K'.$value->course->course_name;
                $value->department_name=$value->department->department_name;
                $value->course_name=$value->course->course_name;
                unset($value->department);
                unset($value->course);
                unset($value->classes_name);
            }

            return Datatables::of($classes)
                ->addIndexColumn()
                ->addColumn('action', function ($classe) {
                    return
                        '<button type="button" class="edit btn btn-primary btn-sm"><a href="' . route('classes.view_update', $classe->id) . '" style="color:#fff; text-decoration: none;"><i class="fas fa-cogs text-dark-pastel-blue"></i>Edit</a></button>
                        <button type="button" style="display:none" name="delete" id="' . $classe->id . '" class="delete btn btn-danger btn-sm"><i class="fas fa-times text-orange-white"></i>Delete</button>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('classes.view_all');
    }

    public function view_insert()
    {
        $array_course = Course::all();
        $array_department = Department::all();
        return view('classes.view_insert', [
            'array_course' => $array_course,
            'array_department' => $array_department
        ]);
    }

    public function process_insert(Request $rq)
    {
        if ($rq->isMethod("post")) {
            $classes_name = $rq->classes_name;
            $department_id = $rq->department_id;
            $course_id = $rq->course_id;
            Classes::insert([
                'classes_name'  =>  $classes_name,
                'department_id' => $department_id,
                'course_id'     => $course_id
            ]);

            return redirect()->route('classes.view_all')->with('success', 'Thêm lớp thành công');
        } else
            return redirect()->route('classes.view_insert')->with('warning', 'Phương thức truyền vào không đúng');
    }

    public function view_update($id)
    {
        $classes = Classes::find($id);
        $array_course = Course::all();
        $array_department = Department::all();

        return view('classes.view_update', [
            'classes' => $classes,
            'array_course' => $array_course,
            'array_department' => $array_department
        ]);
    }

    public function process_update(Request $rq, $id)
    {
        Classes::find($id)->update($rq->all());

        return redirect()->route('classes.view_all')->with('success', 'Cập nhật lớp thành công');
    }

    public function delete($id)
    {
        $data = Classes::findOrFail($id);
        $data->delete();
    }

    public function del(Request $rq)
    {
        if ($rq->isMethod("post")) {
            $delid = $rq->input('delid');
            $data = Classes::whereIn('id', $delid);
            $data->delete();

            return redirect()->route('classes.view_all')->with('success', 'Lớp đã chọn đã được xoá');
        } else {
            return redirect()->route('classes.view_all')->with('warning', 'Phương thức truyền vào không đúng');
        }
    }
}
