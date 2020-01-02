<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('school_id')->unsigned();
            $table->biginteger('student_id')->unsigned();
            $table->biginteger('studentclass_id')->unsigned();
            $table->biginteger('teacher_id')->unsigned();
            $table->biginteger('subject_id')->unsigned();
            $table->year('year');
            $table->biginteger('term_id')->unsigned();
            $table->date('exam_date');
            $table->integer('maxmarks_paper_1')->nullable();
            $table->integer('maxmarks_paper_2')->nullable();
            $table->integer('maxmarks_paper_3')->nullable();
            $table->integer('maxmarks_paper_4')->nullable();
            $table->integer('marks_paper_1')->nullable();
            $table->integer('marks_paper_2')->nullable();
            $table->integer('marks_paper_3')->nullable();
            $table->integer('marks_paper_4')->nullable();
            $table->integer('create_id');
            $table->integer('delete_id')->nullable();
            $table->integer('update_id')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
            ->references('id')->on('students')
            ->onUpdate('cascade');

            $table->foreign('subject_id')
            ->references('id')->on
            ('subjects')
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
        Schema::dropIfExists('mark_schedules');
    }
}