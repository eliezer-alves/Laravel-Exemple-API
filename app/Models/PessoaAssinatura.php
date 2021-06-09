<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Services\GacConsultas\{
    ConfirmeOnlineService,
    DebitoService,
    InfoMaisEnderecoService,
    InfoMaisSituacaoService,
    InfoMaisTelefoneService,
    ScpcDebitoService,
    ScpcScoreService,
    SpcBrasilService,
    GacConsultaService
};

class PessoaAssinatura extends Model
{
    use HasFactory;

    protected $table = 'cad_pessoa_assinatura';
    protected $primaryKey =  'id_pessoa_assinatura';

    protected $fillable = [
        'nome',
        'cpf',
        'cnpj',
        'celular',
        'telefone',
        'email',
        'sexo',
        'cep',
        'cidade',
        'uf',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'created_at',
        'updated_at',
        'deleted_at',
        'tipo_pessoa_assinatura',
        'score',
        'restricao',
        'renda_mensal',
        'situacao_empregaticia',
        'empresa_trab',
        'data_nascimento',
        'token',
        'id_proposta',
        'data_validacao_token',
        'data_aceite_1',
        'data_aceite_2',
        'ip_cliente',
        'hash_assinatura',
        'celular_envio_sms',
        'email_envio_sms',
        'id_tipo_logradouro',
        'estado_civil',
        'numero_documento_identidade',
        'uf_documento_identidade',
        'tipo_documento_identidade',
        'inscricao_estadual',
        'nome_fantasia',
        'razao_social',
        'id_atividade_comercial',
        'id_tipo_empresa',
        'id_porte_empresa',
        'rendimento_mensal',
        'faturamento_anual',
        'capital_social',
        'ano_faturamento',
        'politicamente_exposto',
        'cargo_politico',
        'parente_politicamente_exposto',
        'cargo_parente_politico',
        'nome_mae',
        'tipo_imovel',
        'data_fundacao',
        'id_cosif',
    ];

    protected $attributes = [
        'nome' => null,
        'cpf' => null,
        'cnpj' => null,
        'celular' => null,
        'telefone' => null,
        'email' => null,
        'sexo' => null,
        'cep' => null,
        'cidade' => null,
        'uf' => null,
        'logradouro' => null,
        'numero' => null,
        'complemento' => null,
        'bairro' => null,
        'tipo_pessoa_assinatura' => null,
        'renda_mensal' => null,
        'situacao_empregaticia' => null,
        'empresa_trab' => null,
        'data_nascimento' => null,
        'id_tipo_logradouro' => null,
        'estado_civil' => null,
        'numero_documento_identidade' => null,
        'uf_documento_identidade' => null,
        'tipo_documento_identidade' => null,
        'politicamente_exposto' => false,
        'cargo_politico' => null,
        'parente_politicamente_exposto' => false,
        'cargo_parente_politico' => null,
        'nome_mae' => null,
        'tipo_imovel' => null,
        'data_fundacao' => null,
        'id_cosif' => null,
        // 'debito' => null,
        // 'infomais_endereco' => null,
        // 'infomais_situacao' => null,
        // 'infomais_telefone' => null,
        // 'scpc_debito' => null,
        // 'scpc_score' => null,
        // 'spc_brasil' => null,
        // 'confirme_online' => null,
        // 'valor_score' => null,
        // 'classificacao_score' => null
    ];

    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'id_proposta', 'id_proposta');
    }

    public function porte()
    {
        return $this->belongsTo(PorteEmpresa::class, 'id_porte_empresa');
    }

    public function atividadeComercial()
    {
        return $this->belongsTo(AtividadeComercial::class, 'id_atividade_comercial');
    }

    public function tipoLogradouro()
    {
        return $this->belongsTo(TipoLogradouro::class, 'id_tipo_logradouro');
    }

    public function cosif()
    {
        return $this->belongsTo(Cosif::class, 'id_cosif');
    }

    public function tipoEmpresa()
    {
        return $this->belongsTo(TipoEmpresa::class, 'id_tipo_empresa');
    }

    public function consultarConfirmeOnline()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new ConfirmeOnlineService(($this->attributes['cpf'] ?? $this->attributes['cnpj']));
        return $this->attributes['confirme_online'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
    }

    public function consultarDebito()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new DebitoService($this->attributes['cpf']);
        return $this->attributes['debito'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
    }

    public function consultarInfomaisEndereco()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new InfoMaisEnderecoService($this->attributes['cpf']);
        return $this->attributes['infomais_endereco'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
    }

    public function consultarInfomaisSituacao()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new InfoMaisSituacaoService($this->attributes['cpf']);
        return $this->attributes['infomais_situacao'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
    }

    public function consultarInfomaisTelefone()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new InfoMaisTelefoneService($this->attributes['cpf']);
        return $this->attributes['infomais_telefone'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
    }

    public function consultarScpcDebito()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new ScpcDebitoService($this->attributes['cpf']);
        return $this->attributes['scpc_debito'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
    }

    public function consultarScpcScore()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new ScpcScoreService($this->attributes['cpf']);
        $this->attributes['scpc_score'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
        $this->attributes['valor_score'] = $this->attributes['scpc_score']->resultado ?? "";
        $this->attributes['classificacao_score'] = _classificarScore(intval($this->attributes['scpc_score']->resultado ?? 0)) ?? "";

        return;
    }

    public function consultarSpcBrasil()
    {
        $gacConsulta = new GacConsultaService;
        $orgaoConsulta = new SpcBrasilService($this->attributes['cpf']);
        return $this->attributes['spc_brasil'] = $gacConsulta->consultar($orgaoConsulta) ?? [];
    }
}

