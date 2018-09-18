<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpertCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experts',function (Blueprint $table){
           $table->integer('category_id')->unsigned();
           $table->foreign('category_id')->references('id')
               ->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experts',function (Blueprint $table){
           $table->dropForeign('category_id');
        });
    }
}
