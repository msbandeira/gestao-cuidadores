<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'bank_name',
        'agency',
        'account_number',
        'account_type',
        'pix_key',
    ];

    // Relacionamento: uma conta bancária pertence a um profissional
    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}