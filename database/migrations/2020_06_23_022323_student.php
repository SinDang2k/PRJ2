<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name', 50);
            $table->string('email', 100)->nullable(); // cột này cho phép sv không có nhưng phải check bằng php
            //để xem có trùng hay không vì null và unique không thể sống chung 1 nhà :))
            $table->string('password', 200);
            $table->date('birthday');
            $table->char('phone', 20);
            $table->string('address', 100);
            $table->boolean('gender');
            $table->integer('classes_id')->unsigned();
            $table->foreign('classes_id')->references('id')->on('classes');
            $table->rememberToken();
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
