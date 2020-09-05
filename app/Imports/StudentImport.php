<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Classes;
use App\Models\Department;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class StudentImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'student_name' => $row['ten'],
            'birthday'     => $this->format_date_office($row['ngay_sinh']),
            'email'        => $row['email'],
            'phone'        => $row['so_dien_thoai'],
            'address'      => $row['dia_chi'],
            'password'     => bcrypt('123456'),
            'gender'       => ($row['gioi_tinh'] == 'Nam') ? 1 : 0,
            'classes_id'   => $this->get_classes_id($row['lop'])
        ]);
    }

    public function format_date_office($value)
    {
        return date_format(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value), 'Y-m-d');
    }

    public function get_classes_id($lop)
    {
        if (preg_match('/([A-Z]+)/', $lop, $matches)) {
            $prefix = $matches[1];
        }

        if (preg_match_all('/([0-9]+)/', $lop, $matches)) {
            $classes_name = $matches[0][0];
            $course_name = str_pad($matches[0][1], 2, "0", STR_PAD_LEFT);
        }

        $classes = $prefix . $classes_name . 'K' . $course_name;

        $department = Department::where('prefix', strtoupper($prefix))->first();

        $course = Course::where('course_name', $course_name)->first();
       
        $class = Classes::where([
            'classes_name'  => $classes,
            'department_id' => $department->id,
            'course_id'     => $course->id
        ])->first();
        return $class->id;
    }
}
