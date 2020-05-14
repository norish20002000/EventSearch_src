<?php

use Illuminate\Database\Seeder;

class EventDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\EventDate::class, 20)->create();
    }
}
