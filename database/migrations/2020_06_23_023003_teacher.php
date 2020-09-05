<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('images', 200);
            $table->string('teacher_name', 50);
            $table->date('birthday');
            $table->char('phone', 20)->unique();
            $table->string('address', 100);
            $table->boolean('gender');
            $table->string('email', 100)->unique();
            $table->boolean('status');
            $table->string('password', 200);
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
