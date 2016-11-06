<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldOnUserQuizAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_quiz_answers', function ($table){
            $table->dropColumn('question_id');
            $table->text('question');
            $table->string('name');
        });

        Schema::table('user_quiz', function ($table){
            $table->string('submitted')->default('n');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_quiz_answers', function ($table){
            $table->integer('question_id');
            $table->dropColumn('question');
            $table->dropColumn('name');
        });

        Schema::table('user_quiz', function ($table){
            $table->dropColumn('submitted')->default('n');
        });
    }
}
