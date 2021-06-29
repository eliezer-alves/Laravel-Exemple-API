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
    ScpcDebitoCnpjService,
    ScpcScoreService,
    ScrService,
    SpcBrasilService,
    GacConsultaService,
    SpcBrasilPlusService
};
use Facade\Ignition\DumpRecorder\Dump;

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
        'assinante'
    ];

    protected $attributes = [
        'nome' => NULL,
        'cpf' => NULL,
        'cnpj' => NULL,
        'celular' => NULL,
        'telefone' => NULL,
        'email' => NULL,
        'sexo' => NULL,
        'cep' => NULL,
        'cidade' => NULL,
        'uf' => NULL,
        'logradouro' => NULL,
        'numero' => NULL,
        'complemento' => NULL,
        'bairro' => NULL,
        'tipo_pessoa_assinatura' => NULL,
        'renda_mensal' => NULL,
        'situacao_empregaticia' => NULL,
        'empresa_trab' => NULL,
        'data_nascimento' => NULL,
        'id_tipo_logradouro' => NULL,
        'estado_civil' => NULL,
        'numero_documento_identidade' => NULL,
        'uf_documento_identidade' => NULL,
        'tipo_documento_identidade' => NULL,
        'politicamente_exposto' => false,
        'cargo_politico' => NULL,
        'parente_politicamente_exposto' => false,
        'cargo_parente_politico' => NULL,
        'nome_mae' => NULL,
        'tipo_imovel' => NULL,
        'data_fundacao' => NULL,
        'id_cosif' => NULL,
        'assinante' => true,
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

    public function analisePessoaProposta()
    {
        return $this->hasOne(AnalisePessoaProposta::class, 'id_pessoa_assinatura');
    }

    public function assinou()
    {
        return $this->attributes['hash_assinatura'] != NULL && $this->attributes['data_aceite_1'] != NULL && $this->attributes['data_aceite_2'] != NULL;
    }

    public function possivelAssinar()
    {
        $proposta = $this->proposta()->first();
        return !($this->attributes['hash_assinatura'] != NULL && $this->attributes['data_aceite_1'] != NULL && $this->attributes['data_aceite_2'] != NULL && (!$proposta->cancelada()));
    }

    public function consultarConfirmeOnline($idConsulta = NULL)
    {
        $orgaoConsulta = new ConfirmeOnlineService(($idConsulta ?? $this->attributes['cpf'] ?? $this->attributes['cnpj']));
        $this->attributes['confirme_online'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_confirme_online', $this->attributes['confirme_online']->pessoal->id_confirme_online ?? NULL);
    }

    public function consultarDebito($idConsulta = NULL)
    {
        $orgaoConsulta = new DebitoService($this->attributes['cpf']);
        $this->attributes['debito'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        // dd($this->attributes['debito']);
        return $this->registrarAnalisePessoaProposta('id_scpc', $this->attributes['debito']->scpc->id_scpc ?? NULL, [
            'restricao' => $this->attributes['debito']->valor_total_debitos ?? NULL
        ]);
    }

    public function consultarInfomaisEndereco($idConsulta = NULL)
    {
        $orgaoConsulta = new InfoMaisEnderecoService($idConsulta ?? $this->attributes['cpf']);
        $this->attributes['infomais_endereco'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_info_mais_endereco', $this->attributes['infomais_endereco']->id_info_mais ?? NULL);
    }

    public function consultarInfomaisSituacao($idConsulta = NULL)
    {
        $orgaoConsulta = new InfoMaisSituacaoService($idConsulta ?? $this->attributes['cpf']);
        $this->attributes['infomais_situacao'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_info_mais_situacao', $this->attributes['infomais_situacao']->id_info_mais ?? NULL);
    }

    public function consultarInfomaisTelefone($idConsulta = NULL)
    {
        $orgaoConsulta = new InfoMaisTelefoneService($idConsulta ?? $this->attributes['cpf']);
        $this->attributes['infomais_telefone'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_info_mais_telefone', $this->attributes['infomais_telefone']->id_info_mais ?? NULL);
    }

    public function consultarScpcDebito($idConsulta = NULL)
    {
        $orgaoConsulta = new ScpcDebitoService($idConsulta ?? $this->attributes['cpf']);
        $this->attributes['scpc_debito'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_scpc', $this->attributes['scpc_debito']->id_scpc ?? NULL);
    }

    public function consultarScpcDebitoCnpj($idConsulta = NULL)
    {
        $orgaoConsulta = new ScpcDebitoCnpjService($idConsulta ?? $this->attributes['cnpj']);
        $this->attributes['scpc_debito'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_scpc', $this->attributes['scpc_debito']->id_scpc ?? NULL);
    }

    public function consultarScpcScore($idConsulta = NULL)
    {
        $orgaoConsulta = new ScpcScoreService($idConsulta ?? $this->attributes['cpf']);
        $this->attributes['scpc_score'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        $this->attributes['valor_score'] = $this->attributes['scpc_score']->resultado ?? "";
        $this->attributes['classificacao_score'] = _classificarScore(intval($this->attributes['scpc_score']->resultado ?? 0)) ?? "";
        return $this->registrarAnalisePessoaProposta('id_score', $this->attributes['scpc_score']->id_score ?? NULL, [
            'score' => $this->attributes['valor_score'],
            'classificacao_score' => $this->attributes['classificacao_score']
        ]);
    }

    public function consultarScr($idConsulta = NULL)
    {
        $orgaoConsulta = new ScrService($idConsulta ?? $this->attributes['cpf'] ?? $this->attributes['cnpj']);
        $this->attributes['scr'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_scr', $this->attributes['scr']->id_scr ?? NULL);
    }

    public function consultarSpcBrasil($idConsulta = NULL)
    {
        $orgaoConsulta = new SpcBrasilService($idConsulta ?? $this->attributes['cpf']);
        $this->attributes['spc_brasil'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_spc_brasil', $this->attributes['spc_brasil']->id_spc_brasil ?? NULL);
    }

    public function consultarSpcBrasilPlus($idConsulta = NULL)
    {
        $orgaoConsulta = new SpcBrasilPlusService($idConsulta ?? $this->attributes['cpf'] ?? $this->attributes['cnpj']);
        $this->attributes['spc_brasil_plus'] = ($idConsulta != NULL ? GacConsultaService::consultarById($orgaoConsulta) : GacConsultaService::consultar($orgaoConsulta)) ?? [];
        return $this->registrarAnalisePessoaProposta('id_spc_brasil_plus', $this->attributes['spc_brasil_plus']->id_spc_brasil_plus ?? NULL);
    }

    private function registrarAnalisePessoaProposta($consulta, $idConsulta, $attributes = [])
    {
        if($idConsulta == NULL)return;

        $proposta = $this->proposta()->first();
        $analise = $this->analisePessoaProposta()->first() ?? AnalisePessoaProposta::create([
            'id_proposta' => $proposta->id_proposta,
            'id_analise_proposta' => $proposta->analise->id_analise_proposta,
            'id_pessoa_assinatura' => $this->attributes['id_pessoa_assinatura'],
        ]);
        $analise->update($attributes);
        $analise[$consulta] = $idConsulta;
        return $analise->save();
    }
}
