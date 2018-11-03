<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse__products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('image');
            $table->integer('qty');
            $table->string('donvi');
            $table->integer('price');
            $table->integer('sum');
            $table->string('note')->default(0);
            $table->integer('id_warehouse')->unsigned();
            $table->foreign('id_warehouse')->references('id')->on('warehouses')->onDelete('cascade');
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
        Schema::dropIfExists('warehouse__products');
    }
}
