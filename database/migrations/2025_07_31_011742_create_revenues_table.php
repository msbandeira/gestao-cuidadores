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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // Descrição da entrada (ex: "Recebimento de Consulta", "Venda de Produto")
            $table->decimal('amount', 10, 2); // Valor da entrada
            $table->date('revenue_date'); // Data em que a entrada ocorreu
            $table->string('type')->nullable(); // Tipo de entrada (ex: "Consulta", "Plano", "Outros")
            $table->text('notes')->nullable(); // Observações
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
