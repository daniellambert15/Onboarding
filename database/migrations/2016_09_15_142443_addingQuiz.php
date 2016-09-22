<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function ($table){
            $table->increments('id');
            $table->string('title');
            $table->text('questions');
            $table->text('answers');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_quiz', function ($table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->text('answer');
            $table->boolean('approved')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(
            [
                'quizzes',
                'user_quiz'
            ]
        );
    }
}
