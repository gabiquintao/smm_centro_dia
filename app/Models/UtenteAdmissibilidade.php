<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UtenteAdmissibilidade extends Model
{
    use HasFactory;

    protected $table = 'utente_admissibilidade';

    protected $fillable = [
        'utente_id',
        'is_entregues_docs_necessarios',
        'is_admissibilidade_1',
        'is_admissibilidade_2',
        'is_admissibilidade_3',
        'tipo_admissivel',
        'razao_nao_admissivel',
        'preenchido_por_colaborador_id'
    ];

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class);
    }
}
