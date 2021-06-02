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
        'id_usuario',
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
        'id_status_analise_proposta',
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
        'valor_limite_liberado_bcard',
        'atd_protocolo',
        'atd_celular'
    ];

    protected $attributes = [
        'politicamente_exposto' => false,
        'parente_politicamente_exposto' => false,
    ];

    public function documentos()
    {
        return $this->hasMany(DocumentoProposta::class, 'id_proposta', 'id_proposta');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function clienteAssinatura()
    {
        return $this->hasOne(PessoaAssinatura::class, 'id_proposta', 'id_proposta')->where('tipo_pessoa_assinatura', 0);
    }

    public function representante()
    {
        return $this->hasOne(PessoaAssinatura::class, 'id_proposta', 'id_proposta')->where('tipo_pessoa_assinatura', 1);
    }

    public function socios()
    {
        return $this->hasMany(PessoaAssinatura::class, 'id_proposta', 'id_proposta')->where('tipo_pessoa_assinatura', 2);
    }

    public function assinaturas()
    {
        return $this->hasMany(PessoaAssinatura::class, 'id_proposta', 'id_proposta')
            ->whereNotNull('data_aceite_1')
            ->whereNotNull('data_aceite_2')
            ->whereNotNull('hash_assinatura');
    }

    public function parcelas()
    {
        return $this->hasMany(PropostaParcela::class, 'id_proposta', 'id_proposta');
    }

    public function statusAnalise()
    {
        return $this->belongsTo(StatusAnaliseProposta::class, 'id_status_analise_proposta', 'id_status_analise_proposta');
    }

    public function analise()
    {
        return $this->hasOne(AnaliseProposta::class, 'id_proposta', 'id_proposta');
    }

    public function analisePessoaProposta()
    {
        return $this->hasMany(AnalisePessoaProposta::class, 'id_proposta', 'id_proposta');
    }

    public function observacoes()
    {
        return $this->hasMany(ObservacaoProposta::class, 'id_proposta', 'id_proposta');
    }
}
