<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->collation = 'utf8_hungarian_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('kshkod')->unique();
            $table->decimal('x', 13, 6)->nullable();
            $table->decimal('y', 13, 6)->nullable();
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
        Schema::dropIfExists('cities');
    }
}
