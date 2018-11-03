<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_news', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tieude');
            $table->string('keyword');
            $table->text('mieuta');
            $table->longtext('content');
            $table->string('image');
            $table->integer('view')->default(0);
            $table->integer('id_cate_news')->unsigned();
            $table->foreign('id_cate_news')->references('id')->on('cate_news')->onDelete('cascade');
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
        Schema::dropIfExists('products_news');
    }
}
