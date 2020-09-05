<?php

namespace App\Imports;

use Request;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImportDivideByClass implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $count_student = 0;
        foreach ($rows->toArray() as $index => $row)
        {
            $row = array_filter($row);  // Lọc ra những hàng trống
            if (!empty($row)) {         // Lọc từng hàng 1 cho đến khi đến hàng cuối
                $count_student++;
            }
            else{
                unset($rows[$index]);  // Khi đến hàng trống thì xoá đi
            }
        }

        $number_classes = Request::get('classes');
        $number_student_in_class = ceil($count_student / $number_classes);

        // $so_sinh_vien_thua = $count_student % $number_classes;

        // for ($i=0; $i < $number_classes ; $i++) { 
        //     if ($i = $number_classes - 1) {
        //         $number_student_in_class += $so_sinh_vien_thua;
        //     }
        // }


        // dd($count_student, $number_student_in_class, $so_sinh_vien_thua);

        $department_id = Request::get('department_id');
        $course_id = Request::get('course_id');

        //lấy lớp mới mất
        $class=Classes::where([
            'department_id'=>$department_id,
            'course_id'=>$course_id,
        ])->orderBy('id','desc')->take(1)->get();

        if(count($class)==0) // nếu k có lớp nào có ngành và khóa đấy thì
        {
            $class_name=1;
        }
        else{               // nếu có lớp thì cộng lớp lên ví dụ có lớp BKD05K10 rồi thì lớp sau p là 06
            $class_name=intval($class[0]->classes_name)+1;
        }

        $count = 0;
        foreach ($rows as $row)
        {
            if($count == $number_student_in_class){
                $count = 0;
            }
            if($count==0){
                $classes_id = Classes::insertGetId([
                    'classes_name'  => str_pad($class_name++,2,"0",STR_PAD_LEFT),
                    'department_id' => $department_id,
                    'course_id'     => $course_id,
                ]);
            }
            $array = [
                'student_name'  => $row['ten'],
                'birthday'      => date_format(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh']),"Y/m/d"),
                'email'         => $row['email'],
                'password'      => bcrypt('123456'),
                'phone'         => $row['so_dien_thoai'],
                'address'       => $row['dia_chi'],
                'gender'        => ($row['gioi_tinh']=='Nam') ? 1 : 0,
                'classes_id'    => $classes_id
            ];
            Student::create($array);

            $count++;
        }

    }
}
