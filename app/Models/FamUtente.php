<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamUtente extends Model
{
    use HasFactory;

    protected $table = 'fam_utente';

    protected $fillable = [
        'utente_id',
        'nome',
        'dt_nasc',
        'tipo_parentesco',
        'is_vive_com',
        'is_frequenta',
        'tipo_meio_vida',
        'rendimento_mensal',
    ];

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class);
    }
}
