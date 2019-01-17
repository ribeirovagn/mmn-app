<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('binary')->default(true);
            $table->boolean('unilevel')->default(true);
            $table->boolean('withdraw_is_active')->default(true);
            $table->decimal('withdraw_tax', 8, 2)->default(0);
            $table->boolean('leadership_balance')->default(false);
            $table->integer('sys_binary_type_id')->nullable();
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
        Schema::dropIfExists('sys_businesses');
    }
}
