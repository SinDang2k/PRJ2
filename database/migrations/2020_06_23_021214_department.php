<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Department extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->char('prefix', 5)->unique();
            // cái này nó giốn như mã ngành như mình học LẬP TRÌNH thì
            // LÀ BKD còn vẫn phải dữ id để nối bảng đỡ rác dữ liệu
            $table->string('department_name', 50)->unique();
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
