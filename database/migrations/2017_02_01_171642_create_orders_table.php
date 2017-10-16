<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
           $table->string('titularCartao');
            $table->string('parcelas');
            $table->string('bandeira')->nullable();
            $table->integer('valor');
            $table->integer('valor_desconto');
            $table->string('cupom');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('OrderKey')->nullable();
            $table->string('TransactionKey')->nullable();
            $table->string('status')->nullable();
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
         Schema::table('orders', function (Blueprint $table) {       
            $table->dropForeign('orders_user_id_foreign');                      
         });
        Schema::drop('orders');
    }
}
