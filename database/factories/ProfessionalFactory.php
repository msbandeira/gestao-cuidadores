<?php

namespace Database\Factories;

use App\Models\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Professional::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->unique()->cpf(false),
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Masculino', 'Feminino', 'Outro']),
            'address' => $this->faker->streetAddress,
            'neighborhood' => $this->faker->city,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip_code' => $this->faker->postcode,
            'education_level' => $this->faker->randomElement(['Ensino Médio', 'Graduação', 'Pós-graduação', 'Mestrado', 'Doutorado']),
            'relevant_courses' => $this->faker->sentence(5),
            'experience_description' => $this->faker->text,
            'experience_years' => $this->faker->numberBetween(1, 20),
            //'specialties' => $this->faker->json_object->randomElement(['Mediador Escolar', 'Acompanhante Terapêutico (AT)', 'Outro']),
            //'available_hours' => $this->faker->json_object->randomElement(['Manhã', 'Tarde', 'Noite', 'Horário Comercial']),
            'available_days_of_week' => $this->faker->dayOfWeek,
            'accepts_pets' => $this->faker->boolean,
            'has_own_transport' => $this->faker->boolean,
            'transport_details' => $this->faker->optional()->sentence,
            'preferred_regions' => $this->faker->city,
            'personal_description' => $this->faker->paragraph,
            'communication_style' => $this->faker->randomElement(['Comunicativo', 'Assertivo', 'Empático', 'Detalhado']),
            'calming_strategies_knowledge' => $this->faker->boolean,
            'first_aid_training' => $this->faker->boolean,
            'has_cnh' => $this->faker->boolean,
            'smoker' => $this->faker->boolean,
            'religion' => $this->faker->optional()->word,
            'spoken_languages' => $this->faker->randomElement(['Português', 'Português, Inglês', 'Português, Espanhol']),
        ];
    }
}