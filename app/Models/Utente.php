<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Utente extends Model
{
    use HasFactory;

    protected $table = 'utente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'fam_responsavel_id',
        'colaborador_id',
        'nproc',
        'estado',
        'dt_inscricao',
        'dt_admissao',
        'dt_saida',
        'nome',
        'nome_trata',
        'tlm',
        'tlf',
        'email',
        'dt_nasc',
        'tipo_estado_civil',
        'cc',
        'nif',
        'ss',
        'num_utente',
        'sist_saude_id',
        'obs'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dh_validacao_utente' => 'datetime',
        'dh_validacao_responsavel' => 'datetime',
        'dh_validacao_coordenador' => 'datetime',
    ];

    public static function getEstados(): array
    {
        return [
            1 => 'Não Enviado',
            2 => 'Pendente',
            3 => 'Verificado',
            4 => 'Aprovado',
            5 => 'Lista de Espera',
            6 => 'Desaprovado',
            7 => 'Arquivado',
            8 => 'Falha no Sistema',
        ];
    }

    public static function getEstadosCivis(): array
    {
        return [
            1 => 'Solteiro(a)',
            2 => 'Casado(a)',
            3 => 'Separado(a)',
            4 => 'Divorciado(a)',
            5 => 'Viúvo(a)',
        ];
    }

    public static function getHabilitacoes(): array
    {
        return [
            1 => '1º Ciclo (Ensino Básico)',
            2 => '2º Ciclo (Ensino Básico)',
            3 => '3º Ciclo (Ensino Básico)',
            4 => 'Ensino Secundário',
            5 => 'Ensino Superior',
        ];
    }

    public static function getParentescos(): array
    {
        return [
            1 => 'Irmão(ã)',
            2 => 'Primo(a)',
            3 => 'Cônjugue',
            4 => 'Cunhado(a)',
            5 => 'Genro/Nora',
            6 => 'Neto(a)',
            8 => 'Bisneto(a)',
            9 => 'Sobrinho(a)',
            10 => 'Sobrinho(a) neto(a)',
            11 => 'Sobrinho(a) bisneta(a)',
            12 => '1º Primo(a) uma vez removido(a)',
            13 => '1º Primo(a) duas vezes removido(a)',
        ];
    }

    public static function getMeioVida(): array
    {
        return [
            1 => 'Reforma',
            2 => 'Pensão Social',
            3 => 'Pensão Mínima',
            4 => 'Outro',
        ];
    }

    public static function gerarNumeroProcesso(): string
    {
        $numeroProcesso = Str::random(8);

        while (Utente::where('nproc', $numeroProcesso)->exists()) {
            $numeroProcesso = Str::random(8);
        }

        return $numeroProcesso;
    }

    public function verificar()
    {
        $this->estado = 3;
        $this->save();

    }


    public function sistSaude(): BelongsTo
    {
        return $this->belongsTo(SistSaude::class);
    }

    public function infOutras(): HasOne
    {
        return $this->hasOne(UtenteOutrasInf::class);
    }

    public function infEconomica(): HasOne
    {
        return $this->hasOne(UtenteInfEconomica::class);
    }

    public function famResponsavel(): HasOne
    {
        return $this->hasOne(FamResponsavel::class);
    }

    public function suporte(): HasOne
    {
        return $this->hasOne(UtenteSuporte::class);
    }

    public function admissibilidade(): HasOne
    {
        return $this->hasOne(FamResponsavel::class);
    }

    public function famUtente(): HasMany
    {
        return $this->hasMany(FamUtente::class);
    }

}
