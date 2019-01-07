<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Http\Enum\BinarySideEnum;
use App\Http\Enum\UserStatusEnum;

class CreateGenealogiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genealogies', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('side')->default(0);
            $table->tinyInteger('preferencial_side')->default(BinarySideEnum::AUTO);
            $table->tinyInteger('status')->default(UserStatusEnum::PENDING);
            $table->integer('indicator')->unsigned();
            $table->integer('father')->nullable();
            $table->integer('child_0')->nullable();
            $table->integer('child_1')->nullable();
            $table->boolean('binary')->default(0);
            $table->dateTime('date_positioning')->nullable();
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
        Schema::dropIfExists('genealogies');
    }
}
