<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_catetitle');
            $table->string('keyword');
            $table->string('image')->default(0);
            $table->integer('id_cates')->unsigned();
            $table->foreign('id_cates')->references('id')->on('cates')->onDelete('cascade');
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
        Schema::dropIfExists('subcates');
    }
}
