<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'professional_repass_value', // Adicionado
        'company_intake_value',      // Adicionado
        'plan_type',
        'hours_included',
        'days_validity',
        'is_active',
        'benefits',
        'restrictions',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'professional_repass_value' => 'decimal:2', // Adicionado
        'company_intake_value' => 'decimal:2',      // Adicionado
        'is_active' => 'boolean',
        'benefits' => 'array',
        'restrictions' => 'array',
    ];
}