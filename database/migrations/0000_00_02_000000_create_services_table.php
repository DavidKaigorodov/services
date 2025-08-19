<?php

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('main__services', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->time('duration');

            $table->timestamps();
        });

        Schema::create('main__user_service', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained(new User()->getTable());
            $table->foreignId('service_id')->constrained(new Service()->getTable());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__user_service');
        Schema::dropIfExists('main__services');
    }
};
