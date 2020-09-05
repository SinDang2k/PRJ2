<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use DataTables;
use Alert;

class DepartmentController extends Controller
{
    public function view_all(Request $rq)
    {
        if ($rq->ajax()) {
            $departments = Department::get();
            return Datatables::of($departments)
                ->addIndexColumn()
                ->addColumn('action', function ($department) {
                    return
                        '<button type="button" class="edit btn btn-primary btn-sm"><a href="' . route('department.view_update', $department->id) . '" style="color:#fff; text-decoration: none;"><i class="fas fa-cogs text-dark-pastel-blue"></i>Edit</a></button>
                        <button type="button" style="display:none" name="delete" id="' . $department->id . '" class="delete btn btn-danger btn-sm"><i class="fas fa-times text-orange-white"></i>Delete</button>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('department.view_all');
    }

    public function view_insert()
    {
        return view('department.view_insert');
    }

    public function process_insert(Request $rq)
    {
        if ($rq->isMethod("post")) {
            try {
                Department::create($rq->all());
                return redirect()->route('department.view_all')->with('success', 'Thêm ngành thành công');
            } catch (\Throwable $th) {
                return redirect()->route('department.view_insert');
            }
        } else
            return redirect()->route('department.view_insert')->with('warning', 'Phương thức truyền vào không đúng');
    }

    public function view_update($id)
    {
        $department = Department::find($id);

        return view('department.view_update', [
            'department' => $department
        ]);
    }

    public function process_update(Request $rq, $id)
    {
        Department::find($id)->update($rq->all());

        return redirect()->route('department.view_all')->with('success', 'Cập nhật ngành thành công');
    }

    public function delete($id)
    {
        $data = Department::findOrFail($id);
        $data->delete();
    }

    public function del(Request $rq)
    {
        if ($rq->isMethod("post")) {
            $delid = $rq->input('delid');
            $data = Department::whereIn('id', $delid);
            $data->delete();

            return redirect()->route('department.view_all')->with('success', 'Ngành được chọn đã được xoá');
        } else {
            return redirect()->route('department.view_all')->with('warning', 'Phương thức truyền vào không đúng');
        }
    }
}
