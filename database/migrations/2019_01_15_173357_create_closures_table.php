<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closures', function (Blueprint $table) {
            $table->integer('binary_closure_id')->unsigned();
            $table->foreign('binary_closure_id')->references('id')->on('binary_closures');            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('dots_binary_0')->default(0);
            $table->integer('dots_binary_1')->default(0);
            $table->integer('dots_unilevel')->default(0);
            $table->integer('graduation_id')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->decimal('binary_percentage', 4, 2);
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
        Schema::dropIfExists('closures');
    }
}
