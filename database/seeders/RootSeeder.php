<?php

namespace Database\Seeders;

use App\Models\UserRole;
use App\Models\User;
use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::create(['code' => 'org.name', 'value' => 'ГКУ ЦСВИ', 'name' => 'Наименование организации']);

        User::create([
            'name' => 'root',
            'email' => 'root',
            'password' => Hash::make('root'),
            'division_id' => null,
            'role_id' => UserRole::byCode('root')->id,
            'email_verified_at' => now(),
        ]);
    }
}
