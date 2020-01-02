<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('school_id')->unsigned();
            $table->biginteger('user_id')->unsigned();
            $table->integer('gender_id')->nullable();
            $table->string('idnumber')->nullable()->unique();
            $table->text('address')->nullable();
            $table->string('phonenumber')->nullable();
            $table->date('date_started')->nullable();
            $table->integer('create_id');
            $table->integer('delete_id')->nullable();
            $table->integer('update_id')->nullable();
            $table->integer('activestatus_id');
            $table->integer('allocatestatus_id');
            $table->timestamps();

            $table->foreign('user_id')
                   ->references('id')->on('users')
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
        Schema::dropIfExists('teachers');
    }
}
