<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments',function (Blueprint $table){
           $table->increments('id');
           $table->integer('user_id')->unsigned();
           $table->integer('video_id')->unsigned();
           $table->string('comment');
           $table->timestamps();
           $table->foreign('user_id')->references('id')
               ->on('users')->onDelete('cascade');
           $table->foreign('video_id')->references('id')
               ->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
