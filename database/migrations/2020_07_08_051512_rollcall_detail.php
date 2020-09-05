<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RollcallDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rollcall_detail', function (Blueprint $table) {
            $table->integer('rollcall_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->tinyInteger('status');
            $table->foreign('rollcall_id')->references('id')->on('rollcall');
            $table->foreign('student_id')->references('id')->on('student');
            $table->primary(['rollcall_id', 'student_id']);
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
