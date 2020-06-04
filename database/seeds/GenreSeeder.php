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
            'name' => 'entertainment',
            'disp_name' => 'エンタメ',
        ]);
        DB::table('genres')->insert([
            'name' => 'workshop',
            'disp_name' => 'ワークショップ・講座',
        ]);
        DB::table('genres')->insert([
            'name' => 'culture',
            'disp_name' => 'カルチャー・学び',
        ]);
        DB::table('genres')->insert([
            'name' => 'hobby',
            'disp_name' => '趣味・レジャー',
        ]);
        DB::table('genres')->insert([
            'name' => 'family',
            'disp_name' => 'キッズ・ファミリー',
        ]);
        DB::table('genres')->insert([
            'name' => 'animal',
            'disp_name' => '動物',
        ]);
        DB::table('genres')->insert([
            'name' => 'business',
            'disp_name' => 'ビジネス',
        ]);
    }
}
