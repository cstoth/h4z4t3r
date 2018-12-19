<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAdvertiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->integer('price')->unsigned()->default(0);
            $table->integer('hours')->unsigned()->nullable();
            $table->integer('status')->unsigned()->default(1);
            $table->boolean('highway')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('hours');
            $table->dropColumn('status');
            $table->dropColumn('highway');
        });
    }
}
