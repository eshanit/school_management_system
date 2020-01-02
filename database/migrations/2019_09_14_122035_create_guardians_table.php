<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('school_id')->unsigned();
            $table->biginteger('student_id')->unsigned();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->text('idnumber');
            $table->text('address')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email')->nullable();
            $table->integer('create_id');
            $table->integer('delete_id')->nullable();
            $table->integer('update_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('student_id')
            ->references('id')->on('students')
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
        Schema::dropIfExists('guardians');
    }
}
