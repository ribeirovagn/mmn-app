<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_resumes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('amount', 12, 2)->default(0);
            $table->decimal('debit', 12, 2)->default(0);
            $table->decimal('amount_lidership', 12, 2)->default(0);
            $table->decimal('debit_lidership', 12, 2)->default(0);
            $table->decimal('bonus_limits', 12, 2)->default(0);
            $table->decimal('amount_bonus', 12, 2)->default(0);
            $table->decimal('reversal', 12, 2)->default(0);
            $table->decimal('withdraw', 12, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_resumes');
    }
}
