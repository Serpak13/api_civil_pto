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
        Schema::create('act_object', function (Blueprint $table) {
            $table->id();
            $table->foreignId('act_id')->nullable()->constrained('acts')->nullOnDelete();
            $table->foreignId('object_id')->nullable()->constrained('building_objects')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('act_object');
    }
};
