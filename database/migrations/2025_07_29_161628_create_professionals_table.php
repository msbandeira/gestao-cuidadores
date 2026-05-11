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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable(); // Masculino, Feminino, Outro

            // Endereço
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();

            // Formação e Experiência
            $table->string('education_level')->nullable(); // Ensino Médio, Superior, Pós-graduação
            $table->text('relevant_courses')->nullable(); // Cursos sobre TEA, primeiros socorros, etc.
            $table->text('experience_description')->nullable(); // Descrição da experiência com crianças TEA/atípicas
            $table->text('experience_years')->nullable(); // Quantos anos de experiência
            $table->json('specialties')->nullable(); // Ex: Acompanhante terapêutico, mediador escolar, babá

            // Disponibilidade e Preferências
            $table->json('available_hours')->nullable(); // Manhã/Tarde/Noite/Finais de semana
            $table->string('available_days_of_week')->nullable();
            $table->boolean('accepts_pets')->nullable();
            $table->boolean('has_own_transport')->nullable();
            $table->string('transport_details')->nullable(); // Moto, Carro, Usa transporte público
            $table->string('preferred_regions')->nullable(); // Bairros/Cidades que prefere atuar

            // Informações Adicionais para Matching
            $table->text('personal_description')->nullable(); // Sobre si mesmo
            $table->text('communication_style')->nullable(); // Ex: Direta, paciente, lúdica
            $table->text('calming_strategies_knowledge')->nullable(); // Conhecimento em estratégias de acalmia
            $table->boolean('first_aid_training')->nullable(); // Tem treinamento de primeiros socorros
            $table->boolean('has_cnh')->nullable(); // Tem CNH
            $table->boolean('smoker')->nullable(); // Fumante
            $table->string('religion')->nullable(); // Religião (opcional, para matching com famílias)
            $table->string('spoken_languages')->nullable(); // Idiomas falados

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
