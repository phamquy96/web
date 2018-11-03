<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('content');
            $table->integer('price');
            $table->integer('soluong');
            $table->string('image');
            $table->integer('sum');
            $table->integer('finance');
            $table->integer('id_bill')->unsigned();
            $table->foreign('id_bill')->references('id')->on('bills')->onDelete('cascade');
            $table->integer('id_products')->unsigned();
            $table->foreign('id_products')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('bill_details');
    }
}
