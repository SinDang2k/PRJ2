<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Department;
use App\Models\Course;
use App\Models\Point;
use App\Models\Subject;
use App\view_login_student;
use App\Imports\StudentImport;
use App\Imports\StudentImportDivideByClass;
use DataTables;
use Illuminate\Support\Facades\Response;
use Session;


class StudentController extends Controller
{
    public function view_all(Request $rq)
    {
        if ($rq->ajax()) {
            $students=new Student();
            $students = $students->studentInfo();
            
            return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('action', function ($student) {
                return
                '
                <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="flaticon-more-button-of-three-dots"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item delete" name="delete" id="' . $student->id . '" style="cursor: pointer;"><i class="fas fa-times text-orange-red"></i>Xoá</a>
                <a class="dropdown-item" href="' . route('student.view_update', $student->id) . '"><i class="fas fa-cogs text-dark-pastel-green"></i>Sửa</a>
                <a class="dropdown-item shows" name="show" id="' . $student->id . '" style="cursor: pointer;"><i class="far fa-address-card"></i>Hiển thị</a>
                </div>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('student.view_all');
    }

    public function view_insert()
    {
        $array_classes = Classes::all();
        return view('student.view_insert', [
            'array_classes' => $array_classes
        ]);
    }

    public function process_insert(Request $rq)
    {
        if ($rq->isMethod("post")) {
            Student::create(array_merge($rq->all(), ['password' => bcrypt('123456')]));
            return redirect()->route('student.view_all')->with('success', 'Thêm sinh viên thành công');
        } else {
            return redirect()->route('student.view_insert')->with('warning', 'Phương thức truyền vào không đúng');
        }
    }

    public function view_import_excel()
    {
        return view('student.view_import_excel');
    }

    public function process_import_excel(Request $rq)
    {
        //đọc file của các máy server nó khác windows như cách a long dạy nên tôi dùng cách này k biết
        //windows có đọc đc bằng cách này không
        try {
            $path = $rq->file('file_excel')->store('temp');
            $path = storage_path('app') . '/' . $path;
            Excel::import(new StudentImport, $path);
            return redirect()->route('student.view_all');
        } catch (\Throwable $th) {
            return redirect()->route('student.view_import_excel')->with('err', 'Lỗi Import sinh viên');
        }
    }

    public function view_import_excel_year_begin()
    {
        $departments = Department::all();
        $courses     = Course::all();

        return view('student.view_import_excel_year_begin', [
            'departments' => $departments,
            'courses'     => $courses
        ]);
    }

    public function process_import_excel_year_begin(Request $rq)
    {
        try {
            Excel::import(new StudentImportDivideByClass, $rq->excel_student_class);
            return redirect()->route('student.view_all');
        } catch (\Throwable $th) {
            return redirect()->route('student.view_import_excel_year_begin')->with('err', 'Lỗi Import sinh viên');
        }
    }

    public function view_update($id)
    {
        $student = Student::find($id);
        $array_classes = Classes::all();

        return view('student.view_update', [
            'student' => $student,
            'array_classes' => $array_classes
        ]);
    }

    public function process_update(Request $rq, $id)
    {
        Student::find($id)->update($rq->all());

        return redirect()->route('student.view_all')->with('success', 'Cập nhật sinh viên thành công');
    }

    public function show(Request $rq)
    {
        $id = $rq->input('id');
        $student = Student::with('classes')->find($id);

        $output = array(
            'id'                   =>  $student->id,
            'student_name'         =>  $student->student_name,
            'email'                =>  $student->email,
            'birthday'             =>  $student->birthday,
            'phone'                =>  $student->phone,
            'address'              =>  $student->address,
            'gender'               =>  $student->gender,
            'classes_id'           =>  $student->classes->classes_name
        );
        echo json_encode($output);
    }

    public function view_add_students()
    {
        $classes = Classes::get();
        return view('student.insert_students', ['classes' => $classes]);
    }

    public function process_add_students(Request $rq)
    {
        $files = $rq->file('images');
        $time = time();
        for ($i = 0; $i < $rq->student_number; $i++) {
            $time = $time + 1;
            if (!empty($files[$i])) {
                $file_name = $time . '.' . $files[$i]->getClientOriginalName();
                $files[$i]->move('public/upload', $file_name);
                Student::create([
                    'images'       => $file_name,
                    'student_name' => $rq->student_name[$i],
                    'email'        => $rq->email[$i],
                    'password'     => bcrypt('123456'),
                    'birthday'     => $rq->birthday[$i],
                    'phone'        => $rq->phone[$i],
                    'address'      => $rq->address[$i],
                    'gender'       => $rq->gender[$i],
                    'classes_id'   => $rq->classes_id[$i]
                ]);
            }
        }
        return redirect()->route('student.view_all');
    }

    public function delete($id)
    {
        $data = Student::findOrFail($id);
        $data->delete();
    }

    public function del(Request $rq)
    {
        if ($rq->isMethod("post")) {
            $delid = $rq->input('delid');
            $data = Student::whereIn('id', $delid);
            $data->delete();

            return redirect()->route('student.view_all')->with('success', 'Sinh viên đã chọn đã được xoá');
        } else {
            return redirect()->route('student.view_all')->with('warning', 'Phương thức truyền vào không đúng');
        }
    }

    /// Bên Sinh Viên
    public function process_login(Request $rq)
    {
        $student = view_login_student::where('account', $rq->account)->first();
        if (!empty($student) && Hash::check($rq->password, $student->password)) {
            $rq->session()->put('student_id', $student->id);
            $rq->session()->put('student_name', $student->student_name);
            $rq->session()->put('images', $student->images);
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->back()->with('error', 'Lỗi đăng nhập');
        }
    }

    public function getLogout(Request $rq)
    {
        Session::flush();

        return redirect()->route('student.view_login');
    }

    public function info_student(Request $rq, $id)
    {
        $infostudent = Student::selectRaw("student.id as id,
            student_name,
            if(student.gender=1,'Nam','Nữ') as gender,
            classes_name,department_name,course_name,
            classes_id,
            address,birthday,phone,email")
        ->join('classes', 'classes.id', '=', 'student.classes_id')
        ->join('department', 'department.id', '=', 'classes.department_id')
        ->join('course', 'course.id', '=', 'classes.course_id')
        ->find($id);

        return view('student.ui_student.ui_details_student', [
            'infostudent' => $infostudent
        ]);
    }

    public function update_info_student(Request $rq, $id)
    {
        Student::find($id)->update([
            'student_name'  => $rq->student_name,
            'password'      => bcrypt('123456'),
            'gender'        => ($rq->gender == 'Nam') ? 1 : 0,
            'birthday'      => $rq->birthday,
            'email'         => $rq->email,
            'phone'         => $rq->phone,
            'address'       => $rq->address,
            'classes_id'    => $rq->classes_id
        ]);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function info_point_student(Request $rq, $id)
    {
        $infopointstudent = Point::where('student_id', $id)
        ->selectRaw('point, type_exam, subject_name')
        ->join('student', 'point.student_id', 'student.id')
        ->join('subject', 'point.subject_id', 'subject.id')
        ->get();
        $arr=[];
        $abc=[];
        // return $infopointstudent;
        foreach ($infopointstudent as $key1=>$student1) {
            if(!in_array($key1, $abc))
            {
                foreach ($infopointstudent as $key2=>$student2) {
                    if($student1->subject_name==$student2->subject_name && $student1->type_exam!=$student2->type_exam)
                    {
                        $arr[]= (object)['diem_ly_thuyet'=>$student1->point,
                                        'ten_mon'=>$student2->subject_name,
                                        'diem_thuc_hanh'=>$student2->point];
                        $abc[]=$key2;
                    }
                }
            }
        }


        return view('student.ui_student.ui_point_student', [
            'arr' => $arr
        ]);
    }

    public function get_excel_student_by_class()
    {
        return Response::download(public_path('excel_mau/excel_mẫu_theo_lớp.xlsx'),'excel_mẫu_theo_lớp.xlsx', [
            'Content-Length: '. filesize(public_path('excel_mau/excel_mẫu_theo_lớp.xlsx'))
        ]);
    }

    public function get_excel_student_by_department()
    {
        return Response::download(public_path('excel_mau/excel_mẫu_theo_ngành.xlsx'),'excel_mẫu_theo_ngành.xlsx', [
            'Content-Length: '. filesize(public_path('excel_mau/excel_mẫu_theo_ngành.xlsx'))
        ]);
    }
}
