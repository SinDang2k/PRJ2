<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use DataTables;
use Alert;

class CourseController extends Controller
{
    public function view_all(Request $rq)
    {
        if ($rq->ajax()) {
            $courses = Course::get();
            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('action', function ($course) {
                    return
                        '<button type="button" class="edit btn btn-primary btn-sm"><a href="' . route('course.view_update', $course->id) . '" style="color:#fff; text-decoration: none;"><i class="fas fa-cogs text-dark-pastel-blue"></i>Edit</a></button>
                        <button type="button" style="display:none" name="delete" id="' . $course->id . '" class="delete btn btn-danger btn-sm"><i class="fas fa-times text-orange-white"></i>Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('course.view_all');
    }

    public function view_insert()
    {
        return view('course.view_insert');
    }

    public function process_insert(Request $rq)
    {
        if ($rq->isMethod("post")) {
            try {
                Course::create($rq->all());
                return redirect()->route('course.view_all')->with('success', 'Thêm khoá thành công');
            } catch (\Throwable $th) {
                return redirect()->route('course.view_insert');
            }
        } else
            return redirect()->route('course.view_insert')->with('warning', 'Phương thức truyền vào không đúng');
    }

    public function view_update($id)
    {
        $course = Course::find($id);

        return view('course.view_update', [
            'course' => $course
        ]);
    }

    public function process_update(Request $rq, $id)
    {
        Course::find($id)->update($rq->all());

        return redirect()->route('course.view_all')->with('success', 'Cập nhật khoá thành công');
    }

    public function delete($id)
    {
        $data = Course::findOrFail($id);
        $data->delete();
    }

    public function del(Request $rq)
    {
        if ($rq->isMethod("post")) {
            $delid = $rq->input('delid');
            $data = Course::whereIn('id', $delid);
            $data->delete();

            return redirect()->route('course.view_all')->with('success', 'Khoá đã chọn đã được xoá');
        } else {
            return redirect()->route('course.view_all')->with('warning', 'Phương thức truyền vào không đúng');
        }
    }
}
