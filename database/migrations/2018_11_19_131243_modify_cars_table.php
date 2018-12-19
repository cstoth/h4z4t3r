<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('brand');
            $table->string('color');
            $table->unsignedInteger('year');
            $table->string('image')->nullable();
            $table->boolean('smoke')->default(false);
            $table->boolean('cooler')->default(false);
            $table->boolean('pet')->default(false);
            $table->boolean('bag')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('bag');
            $table->dropColumn('pet');
            $table->dropColumn('cooler');
            $table->dropColumn('smoke');
            $table->dropColumn('image');
            $table->dropColumn('year');
            $table->dropColumn('color');
            $table->dropColumn('brand');
        });
    }
}
