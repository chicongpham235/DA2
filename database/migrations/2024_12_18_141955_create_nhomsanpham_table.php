<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhomsanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhomsanpham', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 100)->unique();
            $table->tinyInteger('trangthai')->default(1)->comment('1-public, 0-private');
            $table->tinyInteger('uutien')->default(0)->comment('Thu tu uu tien');
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
        Schema::dropIfExists('nhomsanpham');
    }
}
