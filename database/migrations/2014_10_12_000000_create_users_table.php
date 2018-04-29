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
            $table->bigInteger('id');
            $table->string('name');
            $table->tinyInteger('type'); //admin=1 , manager=2 , receptionist=3 , client=4
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('manage_receptionist')->nullable(); //id of manager 1,5,8....
            $table->bigInteger('receptionist_client')->nullable(); 
            $table->string('image')->default('img/avatar.jpg');
            $table->string('mobile')->nullable();
            $table->string('country')->nullable();
            $table->string('gender');
            $table->integer('accompany_num')->nullable();
            $table->integer('room_num')->nullable();
            $table->integer('price')->nullable();            
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
