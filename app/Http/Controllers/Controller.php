<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Rollcall;
use App\Models\Subject;

class Controller
{
    public function index()
    {
        $student = Student::count();
        $teacher = Teacher::count();
        $classes = Classes::count();
        $subject = Subject::count();
        $dem_gt = Student::selectRaw("if(gender=1,'Nam','Nữ') as gender ,count(id) as number")
            ->groupBy('gender')->orderBy('gender')->get();
        $array = [["Gender", "Number"]];
        if (!empty($dem_gt[0])) {
            switch ($dem_gt[0]->gender) {
                case 'Female':
                    $so_nu = $dem_gt[0]->number;
                    if (!empty($dem_gt[1])) {
                        $so_nam = $dem_gt[1]->number;
                    } else {
                        $so_nam = 0;
                    }
                    $array[] = ['Female', $so_nu];
                    $array[] = ['Male', $so_nam];
                    break;
                default:
                    $so_nam = $dem_gt[0]->number;
                    if (!empty($dem_gt[1])) {
                        $so_nu = $dem_gt[1]->number;
                    } else {
                        $so_nu = 0;
                    }
                    $array[] = ['Female', $so_nu];
                    $array[] = ['Male', $so_nam];
                    break;
            }
        } else {
            $so_nam = 0;
            $so_nu = 0;
        }
        $rollCall = new RollCall();
        $rollCall = $rollCall->getRollCall();
        return view('index', [
            'student' => $student,
            'teacher' => $teacher,
            'classes' => $classes,
            'subject' => $subject,
            'male_student' => $so_nam,
            'female_student' => $so_nu,
            'rollCalls' => $rollCall,
        ])->with('gender', json_encode($array));
    }
}
