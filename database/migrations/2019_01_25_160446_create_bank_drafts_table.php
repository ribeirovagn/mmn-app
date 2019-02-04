<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankDraftsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bank_drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('bank_id')->nullable();
            $table->integer('crypto_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('account_id')->comment('Pode se o ID do banco o ID da plataforma ou um Address de crytomoeda');
            $table->integer('sys_type_account_withdraw_id')->unsigned();
            $table->string('agency')->nullable();
            $table->string('account')->nullable();
            $table->string('operation')->nullable();
            $table->string('note')->nullable();
            $table->string('doc_path')->nullable();
            $table->tinyInteger('verified')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bank_drafts');
    }

}
