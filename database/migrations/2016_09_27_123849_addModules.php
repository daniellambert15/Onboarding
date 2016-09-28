<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function ($table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('module_questions', function ($table){
            $table->increments('id');
            $table->string('name');
            $table->integer('module_id');
            $table->string('question');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::create('user_module_answer', function ($table){
            $table->increments('id');
            $table->integer('module_question_id');
            $table->integer('user_id');
            $table->string('answer');
            $table->boolean('approved')->default(0);
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::table('users', function($table){
            $table->integer('module')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modules');
        Schema::drop('module_questions');
        Schema::drop('user_module_answer');
        Schema::table('users', function($table){
            $table->dropColumn('module');
        });
    }
}
