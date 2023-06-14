<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SistSaude extends Model
{
    use HasFactory;

    protected $table = 'sist_saude';

    protected $fillable = [
        'nome'
    ];

    public function utente(): HasMany
    {
        return $this->hasMany(Utente::class);
    }
}
