<?php

namespace Database\Factories;

use App\Models\child;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChildFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Child::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'age' => $this->faker->numberBetween(1, 15),
            'gender' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'diagnosis' => $this->faker->optional()->sentence(4),
            'tea_level' => $this->faker->randomElement(['Nível 1', 'Nível 2', 'Nível 3']),
            'associated_conditions' => $this->faker->optional()->sentence(5),
            'is_verbal' => $this->faker->boolean,
            'toilet_autonomy' => $this->faker->randomElement(['Completa', 'Parcial', 'Nenhuma']),
            'feeding_autonomy' => $this->faker->randomElement(['Completa', 'Parcial', 'Nenhuma']),
            'hygiene_autonomy' => $this->faker->randomElement(['Completa', 'Parcial', 'Nenhuma']),
            'aggression_behavior' => $this->faker->boolean,
            'routine_rigidity' => $this->faker->randomElement(['Baixa', 'Média', 'Alta']),
            'main_difficulties' => $this->faker->paragraph,
            'calming_strategies' => $this->faker->paragraph,
            'babysitter_tasks' => $this->faker->paragraph,
            'ideal_babysitter_profile' => $this->faker->paragraph,
            'babysitter_age_preference' => $this->faker->randomElement(['18-25', '26-40', 'Mais de 40', 'Sem preferência']),
            'babysitter_gender_preference' => $this->faker->randomElement(['Feminino', 'Masculino', 'Sem preferência']),
            'babysitter_formation_experience' => $this->faker->optional()->sentence(8),
            'babysitter_other_preferences' => $this->faker->optional()->sentence(10),
            'desired_hours' => $this->faker->randomElement(['Manhã', 'Tarde', 'Noite', 'Diurna']),
            'available_days_of_week' => $this->faker->dayOfWeek,
            'residence_neighborhood' => $this->faker->city,
            'residence_city' => $this->faker->city,
            'has_pet' => $this->faker->boolean,
            'easy_public_transport' => $this->faker->boolean,
            // 'client_id' será definido no seeder
        ];
    }
}