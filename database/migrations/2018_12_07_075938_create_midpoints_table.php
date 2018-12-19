<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMidpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('advertise_id')->comment('Hirdetés');
            $table->unsignedInteger('order')->comment('Sorrend');
            $table->unsignedInteger('city_id')->comment('Köztes megálló hely');

            //$table->foreign('advertise_id')->references('id')->on('advertises')->onDelete('cascade');
            //$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('midpoints');
    }
}
