<?php

namespace App\Http\Controllers;

use App\Events\Pusher;
use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Rollcall;
use App\Models\RollcallDetail;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RollcallController extends Controller
{
    public function view_insert(Request $request)
    {
        $classes=Assignment::query()
        ->with(['class'=>function($query){
            $query->with(['department'=>function($query){
                $query->select('id','prefix');
            }])
            ->with(['course'=>function($query){
                $query->select('id','course_name');
            }]);
        }])
        ->where('teacher_id',Auth::guard('teacher')->user()->id)
        ->get()
        ->makeHidden(['teacher_id','subject_id','classes_id']);
        return view('rollcall.view_insert', ['classes' => $classes]);
    }

    public function get_student(Request $request)
    {
        $sessions = Subject::where('id', $request->subject)->get('sessions');
        $rollcall = Rollcall::where(['classes_id' => $request->class, 'subject_id' => $request->subject])->get();
        if (count($rollcall) == 0) {
            return [Student::where('classes_id', $request->class)->get(['id', 'student_name', 'birthday']), $sessions];
        } else {
            $status = Rollcall::selectRaw("student_id,student.student_name,student.birthday,COUNT(status) as dem,if(status=0,'nghi_hoc',if(status=1,'di_hoc','muon_hoc')) as status")
                ->join('rollcall_detail', 'rollcall.id', '=', 'rollcall_detail.rollcall_id')
                ->join('student', 'student.id', '=', 'rollcall_detail.student_id')
                ->groupBy(['status', 'rollcall_detail.student_id', 'student.student_name', 'student.birthday'])
                ->where(['rollcall.classes_id'=>$request->class,'rollcall.subject_id'=>$request->subject])
                ->orderBy('student_id', 'asc')
                ->get();
            foreach ($status as $key => $stt1) {
                if ($stt1->status == "muon_hoc") {
                    if ($stt1->dem == 3) {
                        $stt1->status = "nghi_hoc";
                        $stt1->dem = 1;
                    } elseif ($stt1->dem == 2) {
                        $stt1->status = "nghi_hoc";
                        $stt1->dem = 0.7;
                    } elseif ($stt1->dem == 1) {
                        $stt1->status = "nghi_hoc";
                        $stt1->dem = 0.3;
                    } else {
                        $stt1->status = "nghi_hoc";
                        if ($stt1->dem % 3 == 1) {
                            $so_du = 0.3;
                        } else {
                            $so_du = 0.7;
                        }
                        $stt1->dem = intdiv($stt1->dem, 3) + $so_du;
                    }
                }
                if ($stt1->status == "di_hoc") {
                    $stt1->status = "nghi_hoc";
                    $stt1->dem = 0;
                }
            }
            $arr = [];
            $abc = [];
            foreach ($status as $key1 => $value1) {
                if (!in_array($key1, $arr)) {
                    foreach ($status as $key2 => $value2) {
                        if ($value1->student_id == $value2->student_id && $key1 != $key2) {
                            $value1->dem += $value2->dem;
                            $arr[] = $key2;
                        }
                    }
                    $arr[] = $key1;
                    $abc[] = $value1;
                }
            }
            $date = date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('Y-m-d');
            $times = Rollcall::whereRaw("date(created_at)='$date'")
                ->where(['classes_id' => $request->class, 'subject_id' => $request->subject])
                ->orderBy('id', 'desc')
                ->select('id', 'created_at as khoi_tao')
                ->get();
            if (count($times) > 0) {
                $checked = RollcallDetail::where('rollcall_id', $rollcall[0]->id)->orderBy('student_id', 'asc')->get(['student_id', 'status']);
                return [$abc, $sessions, $times, $checked];
            }
            return [$abc, $sessions, $times];
        }
    }

    public function get_subject(Request $request)
    {
        return Assignment::with('subject')->where(['classes_id' => $request->class_id, 'teacher_id' => Auth::guard('teacher')->user()->id])->get();
    }

    public function process_insert(Request $request)
    {
        try {
            if ($request->rollcall_id > 0) {
                $rollcall = Rollcall::find($request->rollcall_id)->update([
                    'classes_id' => $request->class,
                    'teacher_id' => Auth::guard('teacher')->user()->id,
                    'subject_id' => $request->subject,
                    'updated_at' => Carbon::now()->timestamp
                ]);
                foreach ($request->except('_token', 'class', 'subject', 'rollcall_id') as $key => $part) {
                    RollcallDetail::where(['rollcall_id' => $request->rollcall_id, 'student_id' => $key])->update([
                        'status' => $part
                    ]);
                }
                $class = Classes::with('course')->with('department')->find($request->class);
                $class_name = $class->getFullNameClassAttribute();
                $text = 'Điểm danh lớp ' . $class_name;
                $time = Carbon::now()->format('d F, Y H:i');
                $teacher = Auth::guard('teacher')->user()->teacher_name;
                $position = "Giáo viên";
                event(new Pusher($text, $time, $teacher, $position));
                return redirect()->back()->with('success', 'Update thành công !!!');
            } else {
                $rollcall = Rollcall::create([
                    'classes_id' => $request->class,
                    'teacher_id' => Auth::guard('teacher')->user()->id,
                    'subject_id' => $request->subject
                ]);

                foreach ($request->except('_token', 'class', 'subject', 'rollcall_id') as $key => $part) {
                    RollcallDetail::insert([
                        'rollcall_id' => $rollcall->id,
                        'student_id' => $key,
                        'status' => $part
                    ]);
                }
                $class = Classes::with('course')->with('department')->find($request->class);
                $class_name = $class->getFullNameClassAttribute();
                $text = 'Điểm danh lớp ' . $class_name;
                $time = Carbon::now()->format('d F, Y H:i');
                $teacher = Auth::guard('teacher')->user()->teacher_name;
                $position = "Giáo viên";
                event(new Pusher($text, $time, $teacher, $position));
                return redirect()->back()->with('success', 'Thêm thành công !!!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('warning', 'Lỗi server');
        }
    }

    public function view_history()
    {
        $classes=Classes::with('department')->with('course')->get();
        return view('rollcall.view_history',['classes'=>$classes]);
    }

    public function get_subject_by_class(Request $request)
    {
        return Subject::join('department_subject','department_subject.subject_id','=','subject.id')
        ->join('department','department_subject.department_id','=','department.id')
        ->join('classes','classes.department_id','=','department.id')
        ->where('classes.id',$request->class_id)
        ->get(['subject_name','subject_id']);
    }

    public function get_student_attendance_history(Request $request)
    {
        return Rollcall::query()
        ->with(['RollcallDetail'=>function($query){
            $query->with(['student'=>function($query){
                $query->select('student_name','id');
            }]);
        }])
        ->select('*')
        ->where(['classes_id'=>$request->class_id,'subject_id'=>$request->subject_id])
        ->get()
        ->makeHidden(['classes_id','teacher_id','subject_id','updated_at']);
    }

    public function view_history_for_teacher(Request $request)
    {
        $classes=Assignment::query()
        ->with(['class'=>function($query){
            $query->with(['department'=>function($query){
                $query->select('id','prefix');
            }])
            ->with(['course'=>function($query){
                $query->select('id','course_name');
            }]);
        }])->get()
        ->makeHidden(['classes_id','teacher_id','subject_id']);
        return view('rollcall.view_history',['classes'=>$classes]);
    }
}
