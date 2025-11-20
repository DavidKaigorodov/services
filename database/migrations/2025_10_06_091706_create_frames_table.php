<?php

use App\Models\Division;
use App\Models\FrameStatus;
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
        Schema::create('main__frame', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->foreignId('division_id')->constrained(new Division()->getTable());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glossary__frame_status');
        Schema::dropIfExists('main__frame');
    }
};
