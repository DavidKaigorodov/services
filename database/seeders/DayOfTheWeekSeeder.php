<?php

namespace Database\Seeders;

use App\Models\DayOfTheWeek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayOfTheWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DayOfTheWeek::create(['code' => 'mon', 'name' => 'Понедельник']);
        DayOfTheWeek::create(['code' => 'tue', 'name' => 'Вторник']);
        DayOfTheWeek::create(['code' => 'wed', 'name' => 'Среда']);
        DayOfTheWeek::create(['code' => 'thu', 'name' => 'Четверг']);
        DayOfTheWeek::create(['code' => 'fri', 'name' => 'Пятница']);
        DayOfTheWeek::create(['code' => 'sat', 'name' => 'Суббота']);
        DayOfTheWeek::create(['code' => 'sun', 'name' => 'Воскресенье']);
    }
}
