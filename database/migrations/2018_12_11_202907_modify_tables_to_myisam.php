<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTablesToMyisam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `hunters` ENGINE = MyISAM;');
        DB::statement('ALTER TABLE `midpoints` ENGINE = MyISAM;');

        Schema::table('midpoints', function (Blueprint $table) {
            $table->foreign('advertise_id')->references('id')->on('advertises')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });

        Schema::table('hunters', function (Blueprint $table) {
            $table->foreign('start_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('end_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
