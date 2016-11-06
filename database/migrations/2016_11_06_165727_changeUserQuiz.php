<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_quiz', function ($table){
            $table->dropColumn('submitted');
        });

        Schema::table('user_quiz', function ($table){
            $table->timestamp('submitted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_quiz', function ($table){
            $table->dropColumn('submitted');
        });

        Schema::table('user_quiz', function ($table){
            $table->string('submitted')->default('n');
        });
    }
}
