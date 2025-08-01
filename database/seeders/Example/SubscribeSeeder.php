<?php

namespace Database\Seeders\Example;

use App\Models\Subscribe;
use Illuminate\Database\Seeder;

class SubscribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscribe::factory(150)->create();
    }
}
