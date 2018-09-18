<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos',function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->string('image');
           $table->string('url');
           $table->string('video_id');
           $table->integer('category_id')->unsigned();
           $table->foreign('category_id')->references('id')
               ->on('categories')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
