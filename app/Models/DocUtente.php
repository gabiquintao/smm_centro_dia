<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocUtente extends Model
{
    use HasFactory;

    protected $table = 'doc_utente';

    protected $fillable = [
        'utente_id',
        'dt_recebido',
        'nome_doc',
        'local_fich',
    ];

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class);
    }
}
