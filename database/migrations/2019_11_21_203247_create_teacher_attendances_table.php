<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('teacher_id')->unsigned();
            $table->date('date');
            $table->integer('attendance');
            $table->text('notes')->nullable();
            $table->integer('create_id');
            $table->integer('delete_id')->nullable();
            $table->integer('update_id')->nullable();
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
        Schema::dropIfExists('teacher_attendances');
    }
}
