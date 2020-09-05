<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Course extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->char('course_name', 10)->unique();
            $table->date('begin');
            $table->date('end');
        });
        DB::statement(
            "ALTER TABLE course
            ADD CONSTRAINT check_course CHECK (YEAR(begin)=YEAR(end)-3);"
        );
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
