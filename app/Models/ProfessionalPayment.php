<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'start_date',
        'end_date',
        'total_repass_amount',
        'status',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_repass_amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    // Relacionamento: Um pagamento pertence a um profissional
    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    // Relacionamento: Um pagamento pode ter muitos atendimentos associados
    // ATENÇÃO: ESTE RELACIONAMENTO SERÁ HABILITADO NO PASSO 2 QUANDO MODIFICARMOS O MODELO Appointment
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'professional_payment_id');
    }
}