<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Budapest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            DB::table('cities')->insert([
                'id' => 3183,
                'name'=>'Budapest',
                'kshkod'=> '00000',
                'megye'=> 'Pest',
                'irsz'=> 0,
                'x'=>'19.0531965145',
                'y'=>'47.5011151657',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            //
        });
    }
}
