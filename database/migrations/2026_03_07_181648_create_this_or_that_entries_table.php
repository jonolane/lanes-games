<?php

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
        Schema::create('this_or_that_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_game_id')->constrained()->cascadeOnDelete();
            $table->string('label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('this_or_that_entries');
    }
};
