<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_sanpham', function (Blueprint $table) {
            $table->bigInteger('size_id')->unsigned();
            $table->bigInteger('sanpham_id')->unsigned();
            $table->foreign('size_id')->references('id')->on('size');
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
        Schema::dropIfExists('size_sanpham');
    }
}
