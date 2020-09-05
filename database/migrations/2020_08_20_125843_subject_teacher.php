<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubjectTeacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->integer('subject_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subject');
            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->primary(['subject_id', 'teacher_id']);
        });
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
