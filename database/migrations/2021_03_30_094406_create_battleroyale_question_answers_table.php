<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleroyaleQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battleroyale_question_answers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('answer')->default(0)->comment('1:true-0:false');
            $table->text('text');

            $table->unsignedBigInteger('battleroyale_question_id');
            $table->foreign('battleroyale_question_id')->references('id')->on('battleroyale_questions')->onDelete('cascade');

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
        Schema::dropIfExists('battleroyale_question_answers');
    }
}
