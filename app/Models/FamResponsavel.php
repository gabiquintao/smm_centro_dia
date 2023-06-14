<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamResponsavel extends Model
{
    use HasFactory;

    protected $table = 'fam_responsavel';

    protected $fillable = [
        'utente_id',
        'nome',
        'morada',
        'cp1',
        'cp2',
        'localidade',
        'tlm',
        'tlf',
        'email',
        'dt_nasc',
        'cc',
        'nif',
        'ss',
        'obs',
    ];

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class);
    }
}
