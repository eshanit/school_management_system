<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('user_id')->unsigned();
            $table->biginteger('role_id')->unsigned();
          //  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          //  $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('year');
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
        Schema::dropIfExists('role_user');
    }
}