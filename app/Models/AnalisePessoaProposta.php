<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisePessoaProposta extends Model
{
    use HasFactory;

    protected $table = 'cad_analise_pessoa_proposta';

    protected $primaryKey = 'id_analise_pessoa_proposta';

    protected $fillable = [
        'id_proposta',
        'id_analise_proposta',
        'id_pessoa_assinatura',
        'id_spc_brasil',
        'id_scpc',
        'id_confirme_online',
        'id_info_mais',
        'id_score',
        'restricao',
        'score',
        'classificacao_score',
    ];

    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'id_proposta');
    }

    public function analise()
    {
        return $this->belongsTo(AnaliseProposta::class, 'id_analise_proposta');
    }

    public function pessoaAssinatura()
    {
        return $this->belongsTo(PessoaAssinatura::class, 'id_pessoa_assinatura');
    }
}
