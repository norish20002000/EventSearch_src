<?php

use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name' => '音楽',
        ]);
        DB::table('genres')->insert([
            'name' => 'フェス',
        ]);
        DB::table('genres')->insert([
            'name' => 'ライブ配信',
        ]);
        DB::table('genres')->insert([
            'name' => '家族',
        ]);
        DB::table('genres')->insert([
            'name' => 'eスポーツ',
        ]);
    }
}
