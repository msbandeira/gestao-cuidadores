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
        Schema::table('appointments', function (Blueprint $table) {
            // Adiciona a chave estrangeira nullable
            $table->foreignId('professional_payment_id')
                  ->nullable() // Pode ser nulo até que um pagamento seja gerado para ele
                  ->after('notes') // Posiciona após o campo 'notes'
                  ->constrained('professional_payments')
                  ->onDelete('set null'); // Se o registro de pagamento for excluído, defina este ID como null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['professional_payment_id']); // Remove a foreign key constraint
            $table->dropColumn('professional_payment_id');    // Remove a coluna
        });
    }
};
