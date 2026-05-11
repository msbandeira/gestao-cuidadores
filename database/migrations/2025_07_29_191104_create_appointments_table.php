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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Cliente que recebeu o atendimento
            $table->foreignId('professional_id')->constrained('professionals')->onDelete('cascade'); // Profissional que realizou o atendimento
            $table->foreignId('service_plan_id')->constrained('service_plans')->onDelete('cascade'); // Plano de serviço associado ao atendimento

            $table->dateTime('appointment_date'); // Data e hora do atendimento
            $table->integer('duration_minutes')->nullable(); // Duração em minutos (ex: 60, 90)
            $table->decimal('price_charged', 10, 2); // Preço cobrado do cliente (pode ser diferente do plano se houver ajustes)
            $table->decimal('professional_repass', 10, 2)->nullable(); // Repasse efetivo para o profissional
            $table->decimal('company_intake', 10, 2)->nullable(); // Entrada efetiva para a empresa
            $table->string('status')->default('scheduled'); // Status do atendimento (ex: scheduled, completed, canceled, rescheduled)
            $table->text('notes')->nullable(); // Observações sobre o atendimento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
