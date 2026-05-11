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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Chave estrangeira para o cliente
            $table->string('name'); // Nome da criança

            // Informações da criança (Formulário especial)
            $table->integer('age')->nullable();
            $table->string('gender')->nullable(); // Masculino, Feminino, Outro
            $table->string('diagnosis')->nullable(); // Diagnóstico(s)
            $table->string('tea_level')->nullable(); // Nível 1, Nível 2, Nível 3
            $table->text('associated_conditions')->nullable(); // Outras condições associadas
            $table->boolean('is_verbal')->nullable(); // Sim/Não/Pouco verbal

            // Autonomia
            $table->string('toilet_autonomy')->nullable(); // Sim/Não/Com ajuda
            $table->string('feeding_autonomy')->nullable(); // Sim/Não/Com ajuda
            $table->string('hygiene_autonomy')->nullable(); // Sim/Não/Com ajuda

            // Comportamentos e rotina
            $table->string('aggression_behavior')->nullable(); // Sim/Não/Raros
            $table->boolean('routine_rigidity')->nullable(); // Sim/Não
            $table->text('main_difficulties')->nullable();
            $table->text('calming_strategies')->nullable();

            // Preferências e necessidades da família
            $table->json('babysitter_tasks')->nullable(); // Array de tarefas esperadas
            $table->text('ideal_babysitter_profile')->nullable(); // Perfil ideal
            $table->string('babysitter_age_preference')->nullable();
            $table->string('babysitter_gender_preference')->nullable();
            $table->text('babysitter_formation_experience')->nullable();
            $table->text('babysitter_other_preferences')->nullable(); // Religião, idioma, estilo de comunicação

            // Disponibilidade e logística
            $table->json('desired_hours')->nullable(); // Manhã/Tarde/Noite/Finais de semana
            $table->string('available_days_of_week')->nullable(); // Dias da semana
            $table->string('residence_neighborhood')->nullable();
            $table->string('residence_city')->nullable();
            $table->boolean('has_pet')->nullable(); // Sim/Não
            $table->boolean('easy_public_transport')->nullable(); // Sim/Não

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
