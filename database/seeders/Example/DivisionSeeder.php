<?php

namespace Database\Seeders\Example;

use App\Models\City;
use App\Models\Division;
use App\Models\DivisionShedule;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (City::all() as $city) {
            Division::factory(5)->create(['city_id' => $city->id]);
        }

        foreach (Division::all() as $division) {
            DivisionShedule::create([
                'date_start' => '08:00',
                'date_end' => '17:00',
                'division_id'=> $division->id,
                'day_of_the_week_id' => 1,
            ]);
            DivisionShedule::create([
                'date_start' => '08:00',
                'date_end' => '17:00',
                'division_id'=> $division->id,
                'day_of_the_week_id' => 2,
            ]);
            DivisionShedule::create([
                'date_start' => '08:00',
                'date_end' => '17:00',
                'division_id'=> $division->id,
                'day_of_the_week_id' => 3,
            ]);
            DivisionShedule::create([
                'date_start' => '08:00',
                'date_end' => '17:00',
                'division_id'=> $division->id,
                'day_of_the_week_id' => 4,
            ]);
            DivisionShedule::create([
                'date_start' => '08:00',
                'date_end' => '17:00',
                'division_id'=> $division->id,
                'day_of_the_week_id' => 5,
            ]);
        }
    }
}
