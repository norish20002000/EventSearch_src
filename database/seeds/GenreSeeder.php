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
        ]);
        DB::table('genres')->insert([
            'name' => 'fes',
        ]);
        DB::table('genres')->insert([
            'name' => 'live_delivery',
        ]);
        DB::table('genres')->insert([
            'name' => 'family',
        ]);
        DB::table('genres')->insert([
            'name' => 'e_sports',
        ]);
    }
}
