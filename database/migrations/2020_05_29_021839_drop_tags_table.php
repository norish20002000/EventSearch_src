<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tags');
        // Schema::table('tags', function (Blueprint $table) {
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
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('タグ名');
            $table->integer('status')->default(0)->comment('ステータス');
            $table->timestamps();
        });
        // Schema::table('tags', function (Blueprint $table) {
        //     //
        // });
    }
}
