<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discalendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('event_date');
            $table->string('event_heading');
            $table->text('event_description');
            $table->integer('event_status');//1=active,2 = infield, 3 = completed , 4 = postponed
            $table->text('event_notes'); //after field
            $table->integer('create_id');
            $table->integer('delete_id')->nullable();
            $table->integer('update_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('discalendars');
    }
}
