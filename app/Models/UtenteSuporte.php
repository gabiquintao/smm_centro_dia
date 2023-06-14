<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UtenteSuporte extends Model
{
    use HasFactory;

    protected $table = 'utente_suporte';

    protected $fillable = [
        'utente_id',
        'is_necessita_suporte',
        'tipo_suporte_existente',
        'tipo_grau_dependencia',
        'is_deficiencia_mental',
        'is_deficiencia_visual',
        'is_deficiencia_motora',
        'is_deficiencia_auditiva',
        'motivo_pedido'
    ];

    protected $casts = [
        'is_necessita_suporte' => 'boolean',
    ];

    public static function getTipoSuporte(): array
    {
        return [
            1 => 'Diário e permanente',
            2 => 'Diário e pontual',
            3 => 'Pontual',
            4 => 'Inexistente',
        ];
    }

    public static function getGrauDependencia(): array
    {
        return [
            1 => 'Autónomo, não necessita de apoio',
            2 => 'Necessita de pequenos apoios na vida quotidiana e no apoio à mobilidade',
            3 => 'Necessita de apoio na higiene pessoal, tarefas de vida quotidiana e na mobilidade',
            4 => 'Totalmente dependente para a satisfação das necessidades básicas (alimentação, higiene, etc)',
        ];
    }

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class);
    }
}
