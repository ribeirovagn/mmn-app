<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenealogyResumesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('genealogy_resumes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('indicated')->default(0);
            $table->integer('graduations_id')->default(1);
            $table->integer('dots_unilevel')->default(0);
            $table->integer('dots_binary_0')->default(0);
            $table->integer('dots_binary_1')->default(0);
            $table->integer('quantity_0')->default(0);
            $table->integer('quantity_1')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('genealogy_resumes');
    }

}
