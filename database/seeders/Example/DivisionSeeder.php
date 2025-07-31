<?php

namespace Database\Seeders\Example;

use App\Models\City;
use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (City::get() as $city) {
            Division::factory(5)->create(['city_id' => $city->id]);
        }
    }
}
