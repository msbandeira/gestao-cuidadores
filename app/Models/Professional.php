<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'cpf',
        'date_of_birth',
        'gender',
        'address',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'education_level',
        'relevant_courses',
        'experience_description',
        'experience_years',
        'specialties',
        'available_hours',
        'available_days_of_week',
        'accepts_pets',
        'has_own_transport',
        'transport_details',
        'preferred_regions',
        'tea_level',
        'personal_description',
        'communication_style',
        'calming_strategies_knowledge',
        'first_aid_training',
        'has_cnh',
        'smoker',
        'religion',
        'spoken_languages',
        
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'specialties' => 'array',
        'available_hours' => 'array',
        'accepts_pets' => 'boolean',
        'has_own_transport' => 'boolean',
        'first_aid_training' => 'boolean',
        'has_cnh' => 'boolean',
        'smoker' => 'boolean',
    ];

    // Relacionamento: Um profissional pode ter uma conta bancária
    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class);
    }
}