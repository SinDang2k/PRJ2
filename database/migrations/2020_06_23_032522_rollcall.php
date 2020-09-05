<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RollCall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rollcall', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classes_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->timestamps();
            $table->foreign('classes_id')->references('id')->on('classes');
            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->foreign('subject_id')->references('id')->on('subject');
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
