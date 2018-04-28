<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_number');
            $table->integer('number')->nullable(); //accomany number
            $table->integer('capacity');
            $table->integer('price'); //int , float
            $table->tinyInteger('floor_id'); 
            $table->boolean('is_admin'); 
            $table->tinyInteger('manager_id'); 
            $table->boolean('is_reserved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
