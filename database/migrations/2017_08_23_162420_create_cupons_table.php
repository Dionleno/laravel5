<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cupom');
            $table->integer('quantidade');
            $table->integer('porcentagem');
            $table->integer('maximo');
            $table->string('status');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('cupons', function (Blueprint $table) {       
            $table->dropForeign('cupons_user_id_foreign');                      
         });
        Schema::drop('cupons');
    }
}
