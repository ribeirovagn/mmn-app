<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('description')->nullable();
            $table->string('note')->nullable();
            $table->tinyInteger('type');
            $table->integer('references_id')->nullable();
            $table->integer('order_item_id')->nullable();
            $table->decimal('value', 10, 2);
            $table->tinyInteger('status');
            $table->integer('level')->nullable();
            $table->integer('related')->nullable()->comment('Usando quando uma transacao é vinculada a outra por exemplo a taxa de um saque');
            $table->tinyInteger('operation')->comment('Credito ou Debito');
            $table->integer('bank_draft_id');
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
        Schema::dropIfExists('transactions');
    }
}
