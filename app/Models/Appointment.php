<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'professional_id',
        'service_plan_id',
        'appointment_date',
        'duration_minutes',
        'price_charged',
        'professional_repass',
        'company_intake',
        'status',
        'notes',
        'professional_payment_id',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'price_charged' => 'decimal:2',
        'professional_repass' => 'decimal:2',
        'company_intake' => 'decimal:2',
    ];

    // Relacionamentos
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function servicePlan()
    {
        return $this->belongsTo(ServicePlan::class);
    }

    // Novo relacionamento: Um atendimento pode pertencer a um registro de pagamento
    public function professionalPayment()
    {
        return $this->belongsTo(ProfessionalPayment::class);
    }
}