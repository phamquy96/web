<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhukiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phukiens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('keyword');
            $table->longtext('thongsokithuat');
            $table->integer('price');
            $table->string('thongtinkhuyenmai');
            $table->integer('discount');
            $table->integer('view')->default(0);
            $table->integer('noibat')->default(0);
            $table->integer('soluong')->default(0);
            $table->string('image');
            $table->integer('id_subcates')->unsigned();
            $table->foreign('id_subcates')->references('id')->on('subcates')->onDelete('cascade');
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
        Schema::dropIfExists('phukiens');
    }
}
