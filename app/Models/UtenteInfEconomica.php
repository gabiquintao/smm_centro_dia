<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UtenteInfEconomica extends Model
{
    use HasFactory;

    protected $table = 'utente_inf_economica';

    protected $fillable = [
        'utente_id',
        'rendimento_trabalho',
        'reforma',
        'pensao',
        'complemento_dep',
        'outro_rendimento',
        'medicacao',
        'renda',
        'agua',
        'gaz',
        'energia',
        'telefone',
        'alimentacao',
        'outra_despesa',
    ];

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class);
    }
}
