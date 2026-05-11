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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->unique()->constrained('professionals')->onDelete('cascade'); // Um profissional tem apenas uma conta bancária principal
            $table->string('bank_name'); // Nome do Banco
            $table->string('agency');    // Agência
            $table->string('account_number'); // Número da Conta
            $table->string('account_type')->nullable(); // Tipo de conta (corrente, poupança) - opcional
            $table->string('pix_key')->nullable(); // Chave Pix
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
