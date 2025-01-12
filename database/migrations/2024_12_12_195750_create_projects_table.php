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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_object_id')->nullable()->constrained('building_objects')->nullOnDelete();
            $table->string('name');
            $table->string('project_code')->index();
            $table->enum('project_section', ['ЭОМ', 'КР', 'КМ', 'АХП', 'КЖ', 'ОВ', 'ВК'])->nullable();
            $table->enum('project_stage', ['проект', 'Рабочая документация'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
