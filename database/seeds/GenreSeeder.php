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
            'name' => 'music',
            'disp_name' => '音楽',
        ]);
        DB::table('genres')->insert([
            'name' => 'fes',
            'disp_name' => 'フェス',
        ]);
        DB::table('genres')->insert([
            'name' => 'live_delivery',
            'disp_name' => 'ライブ配信',
        ]);
        DB::table('genres')->insert([
            'name' => 'family',
            'disp_name' => '家族',
        ]);
        DB::table('genres')->insert([
            'name' => 'e_sports',
            'disp_name' => 'eスポーツ',
        ]);
    }
}
