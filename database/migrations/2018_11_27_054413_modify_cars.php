<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            DB::statement('ALTER TABLE `cars` CHANGE `color` `color` VARCHAR(191) CHARACTER SET utf8 COLLATE utf8_general_ci NULL');
            DB::statement('ALTER TABLE `cars` CHANGE `year` `year` INT(10) UNSIGNED NULL');
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
            DB::statement('ALTER TABLE `cars` CHANGE `year` `year` INT(10) UNSIGNED NOT NULL');
            DB::statement('ALTER TABLE `cars` CHANGE `color` `color` VARCHAR(191) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
        });
    }
}
