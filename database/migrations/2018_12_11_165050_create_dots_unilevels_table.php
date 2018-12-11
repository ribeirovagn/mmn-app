<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDotsUnilevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dots_unilevels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('user_id')->unsigned();
            $table->integer('references_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('dots')->default(0);
            $table->tinyInteger('status');
            $table->tinyInteger('type');
            $table->integer('level');
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
        Schema::dropIfExists('dots_unilevels');
    }
}
