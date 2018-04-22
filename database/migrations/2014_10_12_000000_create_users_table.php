<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('type'); //admin=1 , manager=2 , receptionist=3 , client=4
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('manage_receptionist'); //id of manager 1,5,8....
            $table->string('image')->default('../public/img/avatar.jpg');
            $table->string('mobile');
            $table->string('country');
            $table->string('gender');
            $table->integer('accompany_num');
            $table->integer('room_num');
            $table->integer('price');            
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
        Schema::dropIfExists('users');
    }
}
