<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('question');
            $table->string('photo')->nullable();
            $table->string('video')->nullable();

            $table->unsignedBigInteger('battle_id');
            $table->foreign('battle_id')->references('id')->on('battles')->onDelete('cascade');

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
        Schema::dropIfExists('battle_questions');
    }
}
