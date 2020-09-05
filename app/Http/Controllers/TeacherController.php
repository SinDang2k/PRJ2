<?php

namespace App\Http\Controllers;

use App\Events\LockTeacherAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use DataTables;
use App\Models\Subject;
use App\Models\SubjectTeacher;

class TeacherController extends Controller
{
    public function getLogin()
    {
        $title = 'Đăng nhập giáo viên';
        return view('teacher.login', [
            'title' => $title
        ]);
    }

    public function postLogin(Request $request)
    {
        if (Auth::guard('teacher')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->get('remember'))) {
            return redirect()->route('teacher.dashboard');
        } else
            return redirect()->route('teacher.getLogin')->with('error', 'Lỗi đăng nhập');
    }

    public function getLogout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.getLogin');
    }

    public function view_all(Request $rq)
    {
        if ($rq->ajax()) {
            $teachers = Teacher::get();
            foreach ($teachers as $teacher) {
                $teacher->images = asset('public/upload/' . $teacher->images);
            }
            return DataTables::of($teachers)
                ->addIndexColumn()
                ->addColumn('action', function ($teacher) {
                    if($teacher->status==0)
                    {
                        return'
                            <div class="dropdown" style="right:5px">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item delete" name="delete" id="' . $teacher->id . '" style="cursor: pointer;"><i class="fas fa-times text-orange-red"></i>Xoá</a>
                                    <a class="dropdown-item" href="' . route('teacher.view_update', $teacher->id) . '"><i class="fas fa-cogs text-dark-pastel-green"></i>Sửa</a>
                                    <a class="dropdown-item shows" name="show" id="' . $teacher->id . '" style="cursor: pointer;"><i class="far fa-address-card"></i>Hiển thị</a>
                                    <a class="dropdown-item" href="'.route('teacher.lock_teacher_account',['id'=>$teacher->id]).'"  style="cursor: pointer;"><i class="fas fa-lock"></i>Khóa tài khoản</a>
                                </div>
                            </div>';
                    }
                    else{
                        return'
                            <div class="dropdown" style="right:5px">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item delete" name="delete" id="' . $teacher->id . '" style="cursor: pointer;"><i class="fas fa-times text-orange-red"></i>Xoá</a>
                                    <a class="dropdown-item" href="' . route('teacher.view_update', $teacher->id) . '"><i class="fas fa-cogs text-dark-pastel-green"></i>Sửa</a>
                                    <a class="dropdown-item shows" name="show" id="' . $teacher->id . '" style="cursor: pointer;"><i class="far fa-address-card"></i>Hiển thị</a>
                                    <a class="dropdown-item" href="'.route('teacher.open_teacher_account',['id'=>$teacher->id]).'"  style="cursor: pointer;"><i class="fas fa-lock-open"></i>Mở khóa tài khoản</a>
                                </div>
                            </div>';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('teacher.view_all');
    }

    public function view_insert()
    {
        $subjects = Subject::get();
        return view('teacher.view_insert', [
            'subjects' => $subjects
        ]);
    }

    public function process_insert(Request $rq)
    {
        try {
            $file = $rq->avatar;
            if (!empty($file)) {
                // chưa validate from
                $anh = time() . '.' . $file->getClientOriginalExtension();
                //sửa dữ liệu của $rq
                $rq->offsetSet('images', $anh);
                $rq->offsetSet('password', bcrypt($rq->password));
                $rq->offsetSet('status', 0);
                $file->move(public_path('upload'), $anh);
                $teacher = Teacher::create($rq->all());
                foreach ($rq->subjects as $subject) {
                    SubjectTeacher::insert([
                        'subject_id' => $subject,
                        'teacher_id' => $teacher->id
                    ]);
                }
                return redirect()->route('teacher.view_all')->with('success', 'Thêm giáo viên thành công');
            } else {
                return redirect()->route('teacher.view_insert')->with('error', 'File ảnh không tồn tại');
            }
        } catch (\Throwable $th) {
            return redirect()->route('teacher.view_insert');
        }
    }

    public function view_update($id)
    {
        $subjects = Subject::get();
        $array_subject = SubjectTeacher::all();
        $teacher = Teacher::find($id);

        return view('teacher.view_update', [
            'subjects' => $subjects,
            'array_subject' => $array_subject,
            'teacher' => $teacher
        ]);
    }

    public function process_update(Request $rq, $id)
    {
        Teacher::find($id)->update($rq->all());

        return redirect()->route('teacher.view_all')->with('success', 'Cập nhật giáo viên thành công');
    }

    public function delete($id)
    {
        $data = Teacher::findOrFail($id);
        $data->delete();
    }

    public function show(Request $rq)
    {
        $id = $rq->input('id');
        $teacher = Teacher::find($id);
        $output = array(
            'id'                   =>  $teacher->id,
            'images'               =>  asset('public/upload/'.$teacher->images),
            'teacher_name'         =>  $teacher->teacher_name,
            'birthday'             =>  $teacher->birthday,
            'phone'                =>  $teacher->phone,
            'address'              =>  $teacher->address,
            'gender'               =>  $teacher->gender,
            'email'                =>  $teacher->email
        );
        echo json_encode($output);
    }

    public function del(Request $rq)
    {
        if ($rq->isMethod("post")) {
            $delid = $rq->input('delid');
            $data = Teacher::whereIn('id', $delid);
            $data->delete();

            return redirect()->route('teacher.view_all')->with('success', 'Giáo viên đã chọn đã được xoá');
        } else {
            return redirect()->route('teacher.view_all')->with('warning', 'Phương thức truyền vào không đúng');
        }
    }

    public function lock_teacher_account($id)
    {
        Teacher::find($id)->update(['status'=>1]);
        event(new LockTeacherAccount($id));
        return redirect()->back();
    }

    public function open_teacher_account($id)
    {
        Teacher::find($id)->update(['status'=>0]);
        return redirect()->back();
    }
}
