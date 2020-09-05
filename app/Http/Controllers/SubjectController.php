<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Department;
use DataTables;
use Alert;
use App\Models\DepartmentSubject;

class SubjectController extends Controller
{
    public function view_all(Request $rq)
    {
        if ($rq->ajax()) {
            $subjects = DepartmentSubject::with('department')->with('subject')->get();
            return Datatables::of($subjects)
                ->addIndexColumn()
                ->addColumn('action', function ($subject) {
                    return
                        '<button type="button" class="edit btn btn-primary btn-sm"><a href="' . route('subject.view_update', $subject->subject->id) . '" style="color:#fff; text-decoration: none;"><i class="fas fa-cogs text-dark-pastel-blue"></i>Edit</a></button>
                        <button type="button" style="display:none" name="delete" id="' . $subject->subject->id . '" class="delete btn btn-danger btn-sm"><i class="fas fa-times text-orange-white"></i>Delete</button>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('subject.view_all');
    }

    public function view_insert()
    {
        $array_department = Department::all();
        return view('subject.view_insert', [
            'array_department' => $array_department
        ]);
    }

    public function process_insert(Request $rq)
    {
        if ($rq->isMethod("post")) {
            try {
                $rq->offsetSet('subject_name', strtoupper($rq->subject_name));
                $subject = Subject::create($rq->all());
                foreach ($rq->department_id as $value) {
                    DepartmentSubject::insert([
                        'department_id' => $value,
                        'subject_id'    => $subject->id,
                    ]);
                }
                return redirect()->route('subject.view_all')->with('success', 'Thêm môn thành công');
            } catch (\Throwable $th) {
                return redirect()->route('subject.view_insert');
            }
        } else
            return redirect()->route('subject.view_insert')->with('warning', 'Phương thức truyền vào không đúng');
    }

    public function view_update($id)
    {
        $subject = Subject::find($id);
        $array_department = Department::all();
        $department = DepartmentSubject::Where('subject_id', $id)->get();

        return view('subject.view_update', [
            'subject' => $subject,
            'array_department' => $array_department,
            'department' => $department
        ]);
    }

    public function process_update(Request $rq, $id)
    {
        Subject::find($id)->update($rq->all());

        return redirect()->route('subject.view_all')->with('success', 'Cập nhật môn thành công');
    }

    public function delete($id)
    {
        $data = Subject::findOrFail($id);
        $data->delete();
    }

    public function del(Request $rq)
    {
        if ($rq->isMethod("post")) {
            $delid = $rq->input('delid');
            $data = Subject::whereIn('id', $delid);
            $data->delete();

            return redirect()->route('subject.view_all')->with('success', 'Môn được chọn đã được xoá');
        } else {
            return redirect()->route('subject.view_all')->with('warning', 'Phương thức truyền vào không đúng');
        }
    }
}
