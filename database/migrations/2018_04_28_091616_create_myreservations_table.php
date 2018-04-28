<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyreservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myreservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('client_id');
            $table->integer('accompany_number');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('myreservations');
    }
}
