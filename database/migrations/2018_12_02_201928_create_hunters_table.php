<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuntersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('start_city_id')->comment('Indulási hely');
            $table->unsignedInteger('end_city_id')->comment('Érkezési hely');
            $table->unsignedInteger('days')->comment('Utazás napja')->nullable();
            $table->timestamps();

            //$table->foreign('start_city_id')->references('id')->on('cities')->onDelete('cascade');
            //$table->foreign('end_city_id')->references('id')->on('cities')->onDelete('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hunters');
    }
}
