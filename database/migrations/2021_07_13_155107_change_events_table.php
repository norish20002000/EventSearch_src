<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('introduction', 5000)->comment('紹介文')->change();
            $table->string('catchcopy', 20)->nullable()->comment('キャチコピー')->after('title');
            $table->integer('pic_height')->nullable()->comment('画像縦サイズ')->after('image_url');
            $table->string('pic_copyright', 100)->nullable()->comment('画像注釈')->after('pic_height');
            $table->integer('viewer')->nullable()->comment('想定視聴者数')->after('fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('catchcopy');
            $table->dropColumn('pic_height');
            $table->dropColumn('pic_copyright');
            $table->dropColumn('viewer');
            $table->string('introduction', 5000)->comment('紹介文')->change();
        });
    }
}
