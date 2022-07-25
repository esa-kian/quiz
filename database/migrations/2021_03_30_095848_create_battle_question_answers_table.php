<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_question_answers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('answer')->default(0)->comment('1:true-0:false');
            $table->text('text');

            $table->unsignedBigInteger('battle_question_id');
            $table->foreign('battle_question_id')->references('id')->on('battle_questions')->onDelete('cascade');

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
        Schema::dropIfExists('battle_question_answers');
    }
}
