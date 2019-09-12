<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        City::create(['name' => 'Vadodara']);
        City::create(['name' => 'Surat']);
    }
}
