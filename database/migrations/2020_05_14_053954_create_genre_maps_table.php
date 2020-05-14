<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_maps', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('genre_id')->comment('ジャンルid');
            $table->bigInteger('event_id')->comment('イベントid');
            $table->integer('status')->default(0)->comment("ステータス");
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
        Schema::dropIfExists('genre_maps');
    }
}
