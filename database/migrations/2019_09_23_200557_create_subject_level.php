<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectlevel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('school_id')->unsigned();
            $table->biginteger('subject_id')->unsigned();
            $table->biginteger('level_id')->unsigned();
            $table->timestamps();

            
            $table->foreign('subject_id')
                   ->references('id')->on('subjects')
                   ->onUpdate('cascade');

            $table->foreign('level_id')
                   ->references('id')->on('level')
                   ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjectlevel');
    }
}
