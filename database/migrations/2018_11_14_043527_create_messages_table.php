<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->collation = 'utf8_hungarian_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->unsignedInteger('from_user_id');
            $table->unsignedInteger('to_user_id');
            $table->string('subject');
            $table->text('message');
            $table->boolean('readed')->default(false);
            $table->timestamps();

            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
