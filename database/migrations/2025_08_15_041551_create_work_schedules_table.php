<?php

use App\Models\DayOfTheWeek;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('glossary__day_of_the_week', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        Schema::create('main__work_schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_start');
            $table->timestamp('date_end');
            $table->foreignId('user_id')->constrained(new User()->getTable());
            $table->foreignId('day_of_the_week_id')->constrained(new DayOfTheWeek()->getTable());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__work_schedules');
        Schema::dropIfExists('glossary__day_of_the_week');
    }
};
