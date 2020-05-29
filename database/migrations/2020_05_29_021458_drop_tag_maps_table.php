<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTagMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tag_maps');
        // Schema::table('tag_maps', function (Blueprint $table) {
        //     //
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('tag_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tag_id')->comment('タグId');
            $table->bigInteger('event_id')->comment('イベントId');
            $table->integer('status')->default(0)->comment('ステータス');
            $table->timestamps();
        });
        // Schema::table('tag_maps', function (Blueprint $table) {
        //     //
        // });
    }
}
