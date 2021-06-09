<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnaliseProposta extends Model
{
    use HasFactory;

    protected $table = 'cad_analise_proposta';

    protected $primaryKey = 'id_analise_proposta';

    public $timestamps = false;

    protected $fillable = [
        'id_status_analise_proposta',
        'valor_aprovado',
        'id_proposta',
        // 'id_spc_brasil',
        // 'id_scpc',
        // 'id_confirme_online',
        // 'id_info_mais',
        // 'id_score',
        // 'id_proposta',
        // 'valor_regra_score',
        // 'restricao',
        // 'score',
        // 'classificacao_score',
        'data_analise_proposta'
    ];

    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'id_proposta');
    }

    public function statusAnalise()
    {
        return $this->belongsTo(StatusAnaliseProposta::class, 'id_status_analise_proposta');
    }

    public function analisePessoaProposta()
    {
        return $this->hasMany(AnalisePessoaProposta::class, 'id_analise_proposta', 'id_analise_proposta');
    }
}
