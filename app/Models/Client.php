<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'cpf',
        'address',
        'neighborhood',
        'city',
        'state',
    ];

    // Relação com os filhos
    public function children()
    {
        return $this->hasMany(Child::class);
    }
}
