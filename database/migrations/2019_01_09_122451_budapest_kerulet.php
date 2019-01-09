<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BudapestKerulet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            DB::table('cities')->where('id', 393)->update(array('y'=>'47.4968219', 'x'=>'19.0374580'));
            DB::table('cities')->where('id', 394)->update(array('y'=>'47.5393329', 'x'=>'18.9869340'));
            DB::table('cities')->where('id', 395)->update(array('y'=>'47.5671768', 'x'=>'19.0368517'));
            DB::table('cities')->where('id', 396)->update(array('y'=>'47.5648915', 'x'=>'19.0913149'));
            DB::table('cities')->where('id', 397)->update(array('y'=>'47.5002319', 'x'=>'19.0520181'));
            DB::table('cities')->where('id', 398)->update(array('y'=>'47.5098630', 'x'=>'19.0625813'));
            DB::table('cities')->where('id', 399)->update(array('y'=>'47.5027289', 'x'=>'19.0733760'));
            DB::table('cities')->where('id', 400)->update(array('y'=>'47.4894184', 'x'=>'19.0706680'));
            DB::table('cities')->where('id', 401)->update(array('y'=>'47.4649279', 'x'=>'19.0916229'));
            DB::table('cities')->where('id', 402)->update(array('y'=>'47.4820909', 'x'=>'19.1575028'));
            DB::table('cities')->where('id', 403)->update(array('y'=>'47.4593099', 'x'=>'19.0187389'));
            DB::table('cities')->where('id', 404)->update(array('y'=>'47.4991199', 'x'=>'18.9904590'));
            DB::table('cities')->where('id', 405)->update(array('y'=>'47.5355105', 'x'=>'19.0709266'));
            DB::table('cities')->where('id', 406)->update(array('y'=>'47.5224569', 'x'=>'19.1147090'));
            DB::table('cities')->where('id', 407)->update(array('y'=>'47.5589000', 'x'=>'19.1193000'));
            DB::table('cities')->where('id', 408)->update(array('y'=>'47.5183029', 'x'=>'19.1919410'));
            DB::table('cities')->where('id', 409)->update(array('y'=>'47.4803000', 'x'=>'19.2667001'));
            DB::table('cities')->where('id', 410)->update(array('y'=>'47.4457289', 'x'=>'19.1430149'));
            DB::table('cities')->where('id', 411)->update(array('y'=>'47.4332879', 'x'=>'19.1193169'));
            DB::table('cities')->where('id', 412)->update(array('y'=>'47.4243579', 'x'=>'19.0661420'));
            DB::table('cities')->where('id', 413)->update(array('y'=>'47.4250000', 'x'=>'19.0316670'));
            DB::table('cities')->where('id', 414)->update(array('y'=>'47.3939599', 'x'=>'19.1225230'));
            DB::table('cities')->where('id', 415)->update(array('y'=>'47.4250000', 'x'=>'19.0316670'));
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
