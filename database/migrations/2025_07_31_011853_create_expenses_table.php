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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // Descrição da despesa (ex: "Aluguel", "Salário", "Material de Escritório")
            $table->decimal('amount', 10, 2); // Valor da despesa
            $table->date('expense_date'); // Data em que a despesa ocorreu
            $table->string('category')->nullable(); // Categoria da despesa (ex: "Operacional", "Pessoal", "Marketing")
            $table->text('notes')->nullable(); // Observações
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
