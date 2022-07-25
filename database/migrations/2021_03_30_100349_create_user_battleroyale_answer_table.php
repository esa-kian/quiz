<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBattleroyaleAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_battleroyale_answer', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('battleroyale_question_id');
            $table->foreign('battleroyale_question_id')->references('id')->on('battleroyale_questions')->onDelete('cascade');

            $table->unsignedBigInteger('battleroyale_answer_id');
            $table->foreign('battleroyale_answer_id')->references('id')->on('battleroyale_question_answers')->onDelete('cascade');

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
        Schema::dropIfExists('users_battleroyale_answers');
    }
}
