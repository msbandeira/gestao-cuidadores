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
        Schema::create('professional_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained('professionals')->onDelete('cascade');
            $table->date('start_date'); // Data de início do período de faturamento/pagamento
            $table->date('end_date');   // Data de fim do período de faturamento/pagamento
            $table->decimal('total_repass_amount', 10, 2); // Soma total dos repasses para o período
            $table->string('status')->default('pending'); // Status: pending, processing, paid, cancelled
            $table->date('payment_date')->nullable(); // Data em que o pagamento foi efetivado
            $table->text('notes')->nullable(); // Observações sobre o pagamento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_payments');
    }
};
