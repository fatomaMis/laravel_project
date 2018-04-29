<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    class AddFlooridToTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('rooms', function (Blueprint $table) {
                $table->integer('floor_id')->unsigned();
                $table->default('0');
                $table->foreign('floor_id')->references('id')->on('floors');
            });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('rooms', function (Blueprint $table) {
                //
            });
        }
    }
    