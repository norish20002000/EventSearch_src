<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRegiNullableEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('regi_group_name', 255)->nullable()->comment('登録者団体名')->change();
            $table->string('regi_name', 255)->nullable()->comment('登録者担当者名')->change();
            $table->string('regi_mail', 255)->nullable()->comment('登録者メールアドレス')->change();
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
            $table->string('regi_group_name', 255)->comment('登録者団体名')->change();
            $table->string('regi_name', 255)->comment('登録者担当者名')->change();
            $table->string('regi_mail', 255)->comment('登録者メールアドレス')->change();
        });
    }
}
