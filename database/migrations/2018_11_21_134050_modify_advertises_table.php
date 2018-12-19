<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->unsignedInteger('start_city_id')->comment('Indulási hely');
            $table->unsignedInteger('end_city_id')->comment('Érkezési hely');
            $table->timestamp('start_date')->comment('Indulási időpont')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_date')->comment('Érkezési időpont')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('free_seats')->comment('Szabad ülések száma')->default(0);
            $table->boolean('retour')->comment('Oda-vissza')->default(false);
            $table->string('description')->comment('Megjegyzés')->nullable();

            $table->foreign('start_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('end_city_id')->references('id')->on('cities')->onDelete('cascade');
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
            $table->dropColumn('description');
            $table->dropColumn('retour');
            $table->dropColumn('free_seats');
            $table->dropColumn('end_date');
            $table->dropColumn('start_date');
            $table->dropColumn('end_city_id');
            $table->dropColumn('start_city_id');
        });
    }
}
