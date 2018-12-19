<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->unsignedInteger('advertise_id')->comment('Hirdetés');
            $table->foreign('advertise_id')->references('id')->on('advertises');
            $table->timestamp('date')->comment('Hirdetési időpont');
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
        Schema::dropIfExists('dates');
    }
}
