<?php

namespace Database\Seeders\Example;

use Illuminate\Database\Seeder;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CitySeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(SubscribeSeeder::class);
    }
}
