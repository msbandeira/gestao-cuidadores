<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'age',
        'gender',
        'diagnosis',
        'tea_level',
        'associated_conditions',
        'is_verbal',
        'toilet_autonomy',
        'feeding_autonomy',
        'hygiene_autonomy',
        'aggression_behavior',
        'routine_rigidity',
        'main_difficulties',
        'calming_strategies',
        'babysitter_tasks',
        'ideal_babysitter_profile',
        'babysitter_age_preference',
        'babysitter_gender_preference',
        'babysitter_formation_experience',
        'babysitter_other_preferences',
        'desired_hours',
        'available_days_of_week',
        'residence_neighborhood',
        'residence_city',
        'has_pet',
        'easy_public_transport',
    ];

    // Campos que devem ser automaticamente convertidos para array/JSON
    protected $casts = [
        'babysitter_tasks' => 'array',
        'desired_hours' => 'array',
        'is_verbal' => 'boolean',
        'routine_rigidity' => 'boolean',
        'has_pet' => 'boolean',
        'easy_public_transport' => 'boolean',
    ];

    // Relação com o cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
