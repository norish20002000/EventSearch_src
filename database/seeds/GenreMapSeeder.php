<?php

use Illuminate\Database\Seeder;

class GenreMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\GenreMap::class, 10)->create();
    }
}
