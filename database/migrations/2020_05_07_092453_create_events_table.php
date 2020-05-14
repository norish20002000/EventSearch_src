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
            $table->bigIncrements('id')->comment('ID');
            $table->string('title')->comment('イベント名');
            $table->string('introduction')->comment('紹介文');
            $table->time('st_time')->nullable()->comment('開始時間');
            $table->time('end_time')->nullable()->comment('終了時間');
            $table->string('summary_date')->nullable()->comment('日時備考');
            $table->string('web_name')->comment('視聴サイト名');
            $table->string('web_url')->nullable()->comment('視聴URL');
            $table->string('fee_type')->comment('料金種別');
            $table->bigInteger('fee')->nullable()->comment('料金');
            $table->string('image_url')->nullable()->comment('画像url');
            $table->string('reference_name')->nullable()->comment('参考サイト名称');
            $table->string('reference_url')->nullable()->comment('参考URL');
            $table->date('release_date')->comment('公開日');
            $table->string('regi_group_name')->comment('登録者団体名');
            $table->string('regi_name')->comment('登録者担当者名');
            $table->string('regi_tel')->comment('登録者電話番号');
            $table->string('regi_mail')->comment('登録者メールアドレス');
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
