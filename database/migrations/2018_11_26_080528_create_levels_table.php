<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('start')->default(1);
            $table->integer('end')->default(1);
            $table->integer('bonus_id')->unsigned();
            $table->foreign('bonus_id')->references('id')->on('bonuses');
            $table->integer('product_id')->unsigned();
            $table->boolean('is_active')->default(true);
            $table->integer('dots')->default(0);
            $table->integer('type');
            $table->decimal('amount', 10, 2)->default(0);
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
        Schema::dropIfExists('levels');
    }
}
