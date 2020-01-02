<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('school_id');
            $table->biginteger('student_id');
            $table->integer('schoolclass_id');
            $table->date('date');
            $table->year('year');
            $table->integer('term');
            $table->integer('attendance')->unsigned();
            $table->integer('create_id');
            $table->integer('delete_id')->nullable();
            $table->integer('update_id')->nullable();
            $table->integer('activestatus_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_attendances');
    }
}
