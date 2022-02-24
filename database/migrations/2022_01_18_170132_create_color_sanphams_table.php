<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorSanphamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_sanpham', function (Blueprint $table) {
            $table->bigInteger('color_id')->unsigned();
            $table->integer('sanpham_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('sanpham_id')->references('id')->on('sanpham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('color_sanpham');
    }
}
