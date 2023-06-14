<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UtenteOutrasInf extends Model
{
    use HasFactory;

    protected $table = 'utente_outras_inf';

    protected $fillable = [
        'utente_id',
        'morada',
        'cp1',
        'cp2',
        'localidade',
        'is_proximo_na_instituicao',
        'proximo_na_instituicao',
        'tipo_visita',
        'dt_visita',
        'naturalidade',
        'tipo_habilitacoes',
        'habilitacoes_desc',
    ];

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class);
    }

    public static function escolaridade(): array
    {
        return [
            1 => '1º Ciclo',
            2 => '2º Ciclo',
            3 => '3º Ciclo',
            4 => 'Secundário',
            5 => 'Ensino Superior'
        ];
    }

}
