<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('school_id')->unsigned();
            $table->biginteger('grade_id')->unsigned();
            $table->biginteger('subclass_id')->unsigned();
            $table->biginteger('level_id')->unsigned();
            $table->timestamps();
/*
            $table->foreign('grade_id')
                   ->references('id')->on('school_grades')
                   ->onUpdate('cascade');

            $table->foreign('subclass_id')
                   ->references('id')->on('school_sub_classes')
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
        Schema::dropIfExists('school_classes');
    }
}