<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Point extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point', function (Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->tinyInteger('point')->unsigned();
            $table->tinyInteger('type_exam');
            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('subject_id')->references('id')->on('subject');
            $table->primary(['student_id', 'subject_id', 'type_exam']);
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
