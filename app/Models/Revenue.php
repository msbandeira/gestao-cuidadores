<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'revenue_date',
        'type',
        'notes',
    ];

    protected $casts = [
        'revenue_date' => 'date',
        'amount' => 'decimal:2',
    ];
}