<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LoginStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE view view_login_student as
            SELECT student.id as id,
            concat(department.prefix,LPAD(student.id,5,'0')) as account,
            -- student.images as images,
            student.student_name as student_name,
            student.password as password
            FROM student
            JOIN classes
            ON student.classes_id = classes.id
            JOIN department
            ON department.id=classes.department_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
