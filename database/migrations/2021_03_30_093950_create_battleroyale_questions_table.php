<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleroyaleQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battleroyale_questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('question');
            $table->string('photo')->nullable();
            $table->string('video')->nullable();

            $table->unsignedBigInteger('battleroyale_id');
            $table->foreign('battleroyale_id')->references('id')->on('battleroyales')->onDelete('cascade');

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
        Schema::dropIfExists('battleroyale_questions');
    }
}
