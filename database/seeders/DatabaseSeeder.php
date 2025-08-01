<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserRoleSeeder::class);
        $this->call(RootSeeder::class);

        if(in_array(config('app.env'), ['local', 'testing']))
            $this->call(Example\ExampleSeeder::class);

        // $this->call(Sys\SystemConfigurationSeeder::class);

        // $this->call(Admin\CitySeeder::class);
        // $this->call(Admin\DivisionSeeder::class);

        // $this->call(Division\ServiceSeeder::class);

        // $this->call(User\SubscribeSeeder::class);
    }
}
