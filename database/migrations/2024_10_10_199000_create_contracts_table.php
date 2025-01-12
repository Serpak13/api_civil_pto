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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->string('contract_number');
            $table->string('contract_type');
            $table->date('contract_date');
            $table->enum('contract_status', ['на рассмотрении', 'подписан', 'расторгнут', 'завершён']);
            $table->enum('payment_status',['ждём аванс','получен аванс', 'контракт закрыт']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
