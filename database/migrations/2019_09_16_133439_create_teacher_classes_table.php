<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('school_id')->unsigned();
            $table->biginteger('teacher_id')->unsigned();
            $table->biginteger('schoolclass_id')->unsigned();
            $table->integer('year');
            $table->integer('create_id');
            $table->integer('delete_id')->nullable();
            $table->integer('update_id')->nullable();
            $table->timestamps();

            /*
            $table->foreign('teacher_id')
            ->references('id')->on('teachers')
            ->onUpdate('cascade');

            $table->foreign('schoolclass_id')
            ->references('id')->on('school_classes')
            ->onUpdate('cascade');
            */
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_classes');
    }
}
