<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepartmentSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_subject', function (Blueprint $table) {
            $table->integer('department_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('department');
            $table->foreign('subject_id')->references('id')->on('subject');
            $table->primary(['department_id', 'subject_id']);
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
