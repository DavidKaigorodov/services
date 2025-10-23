<?php

namespace Database\Seeders;

use App\Models\FrameStatus;
use Illuminate\Database\Seeder;

class FrameStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrameStatus::create(['code' => 'create',  'name' => 'Создание']);
        FrameStatus::create(['code' => 'created', 'name' => 'Создан']);
        FrameStatus::create(['code' => 'update',  'name' => 'Обновление']);
        FrameStatus::create(['code' => 'updated', 'name' => 'Обновлен']);
    }
}
