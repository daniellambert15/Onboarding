<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Actvities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('activities', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamp('month');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_activities', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('activity_id');
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
        Schema::drop('activities');
        Schema::drop('user_activities');
    }
}
