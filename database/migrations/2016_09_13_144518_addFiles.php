<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_files', function ($table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('file_id');
            $table->text('fileLocation');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('files', function ($table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->text('original');
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_files');
        Schema::drop('files');
    }
}
