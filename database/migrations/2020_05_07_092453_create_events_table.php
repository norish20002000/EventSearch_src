<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment("タイトル");
            $table->string('detail')->comment("詳細");
            $table->string('thumb_url')->comment("サムネイルurl");
            $table->string('image_url')->comment("画像url");
            $table->string('summary')->comment("概要");
            $table->date('st_date')->comment("開始日");
            $table->date('end_date')->comment("終了日");
            $table->time('st_time')->comment("開始時間");
            $table->time('end_time')->comment("終了時間");
            $table->bigInteger('fee')->comment("料金");
            $table->text('deli_format')->comment("提供形式");
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
        Schema::dropIfExists('events');
    }
}
