<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewQuiz extends Migration
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
            $table->string('name');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('quiz_questions', function ($table){
            $table->increments('id');
            $table->integer('quiz_id');
            $table->string('name');
            $table->text('question');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_quiz', function ($table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_quiz_answers', function ($table){
            $table->increments('id');
            $table->integer('user_quiz');
            $table->integer('question_id');
            $table->text('answer');
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
        Schema::drop('quizzes');
        Schema::drop('quiz_questions');
        Schema::drop('user_quiz_answers');
    }
}
