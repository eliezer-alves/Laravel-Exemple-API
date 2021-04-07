<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cad_proposta';
    protected $primaryKey =  'id_proposta';

    protected $fillable = [
        'contrato',
        'id_simulacao',
        'estado_civil',
        'renda',
        'situacao_empregaticia',
        'descricao_empresa',
        'valor_solicitado',
        'nome_beneficiario',
        'cpf_beneficiario',
        'cnpj_beneficiario',
        'forma_liberacao',
        'valor_liberacao',
        'banco_liberacao',
        'agencia_liberacao',
        'digito_agencia_liberacao',
        'conta_liberacao',
        'digito_conta_liberacao',
        'tipo_conta',
        'tipo_documento_identidade',
        'uf_documento_identidade',
        'numero_documento_identidade',
        'politicamente_exposto',
        'cargo_politico',
        'parente_politicamente_exposto',
        'cargo_parente_politico',
        'plano',
        'data_solicitacao_proposta',
        'id_cliente',
        'id_acesso_bio',
        'id_status_administrativo',
        'cidade_geo',
        'estado_geo',
        'dados_completos_geo',
        'valor_iof',
        'tac',
        'valor_financiado_total',
        'valor_liquido_credito',
        'valor_parcela',
        'quantidade_parcela',
        'taxa_juros_ano',
        'cet_mes',
        'cet_ano',
        'valor_seguro',
        'data_geracao_proposta',
        'data_geracao_contrato',
        'data_remessa_contrato',
        'data_aceite_1',
        'data_aceite_2',
        'hash_assinatura_ccb',
        'data_visualizacao_proposta',
        'taxa_juros_mes',
        'id_forma_inclusao',
        'valor_total_a_pagar',
        'valor_limite_liberado_bcard'
    ];

    protected $attributes = [
        // 'contrato' => null,
        // 'id_simulacao' => null,
        // 'renda' => null,
        // 'situacao_empregaticia' => null,
        // 'descricao_empresa' => null,
        // 'valor_solicitado' => null,
        // 'nome_beneficiario' => null,
        // 'cpf_beneficiario' => null,
        // 'cnpj_beneficiario' => null,
        // 'forma_liberacao' => null,
        // 'valor_liberacao' => null,
        // 'banco_liberacao' => null,
        // 'agencia_liberacao' => null,
        // 'digito_agencia_liberacao' => null,
        // 'conta_liberacao' => null,
        // 'digito_conta_liberacao' => null,
        // 'tipo_conta' => null,
        // 'tipo_documento_identidade' => null,
        // 'uf_documento_identidade' => null,
        // 'numero_documento_identidade' => null,
        'politicamente_exposto' => false,
        // 'cargo_politico' => null,
        'parente_politicamente_exposto' => false,
        // 'cargo_parente_politico' => null,
        // 'data_solicitacao_proposta' => null,
        // 'id_cliente' => null,
        // 'id_status_administrativo' => null,
        // 'quantidade_parcela' => null,
        // 'id_forma_inclusao' => null,
    ];

    public function documento()
    {
        return $this->belongsTo(DocumentoProposta::class, 'id_proposta', 'id_proposta');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'id_proposta');
    }
}
