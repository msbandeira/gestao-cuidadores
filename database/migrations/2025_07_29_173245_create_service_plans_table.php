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
        Schema::create('service_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nome do plano (ex: "Pacote de Horas", "Mensal Básico")
            $table->string('description')->nullable(); // Descrição detalhada do plano
            $table->decimal('price', 10, 2); // Preço do plano
            $table->string('plan_type')->nullable(); // Tipo de plano (ex: "Por Hora", "Mensal", "Avulso")
            $table->integer('hours_included')->nullable(); // Número de horas incluídas no plano (se aplicável)
            $table->integer('days_validity')->nullable(); // Validade em dias (se aplicável, ex: 30 dias para um plano mensal)
            $table->boolean('is_active')->default(true); // Se o plano está ativo para novos cadastros
            $table->json('benefits')->nullable(); // Lista de benefícios (ex: "Suporte 24h", "Desconto em cursos")
            $table->json('restrictions')->nullable(); // Lista de restrições (ex: "Válido apenas em dias úteis")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_plans');
    }
};
