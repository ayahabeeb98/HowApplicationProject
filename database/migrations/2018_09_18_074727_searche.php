<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Searche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search',function (Blueprint $table){
           $table->increments('id');
           $table->integer('user_id')->unsigned();
           $table->string('content');
           $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')
               ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search');
    }
}
