<?php

namespace App\Http\Requests;

use App\Rules\Uf;
use Illuminate\Foundation\Http\FormRequest;

class AlterarDadosPropostaAnaliseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'proposta.id_proposta' => ['required', 'numeric', 'exists:cad_proposta,id_proposta'],
            'proposta.nova_id_simulacao' => ['numeric'],
            // 'proposta.id_simulacao' => ['required', 'numeric'],
            'proposta.valor_solicitado' => ['required', 'numeric', 'max:1000000'],
            'proposta.primeiro_vencimento' => ['required', 'date'],
            'proposta.forma_liberacao' => ['required', 'string'],
            'proposta.banco_liberacao' => ['required', 'string'],
            'proposta.agencia_liberacao' => ['required', 'regex:/^[0-9]+$/u', 'max:4'],
            'proposta.digito_agencia_liberacao' => ['required', 'regex:/^[0-9]+$/u', 'max:2'],
            'proposta.conta_liberacao' => ['required', 'regex:/^[0-9]+$/u', 'min:6'],
            'proposta.digito_conta_liberacao' => ['required', 'regex:/^[0-9]+$/u', 'max:2'],
            'proposta.tipo_conta' => ['required', 'max:1'],
            'proposta.atd_protocolo' => ['required'],
            'proposta.atd_celular' => ['required'],

            'cliente.id_pessoa_assinatura' => ['required', 'regex:/^[0-9]+$/u', 'exists:cad_pessoa_assinatura,id_pessoa_assinatura'],
            'cliente.cnpj' => ['required', 'regex:/^[0-9]+$/u'],
            'cliente.nome_fantasia' => ['required', 'string'],
            'cliente.razao_social' => ['required', 'string'],
            'cliente.inscricao_estadual' => ['required', 'regex:/^[0-9]+$/u', 'max:14'],
            'cliente.data_fundacao' => ['required', 'date'],
            'cliente.id_atividade_comercial' => ['required', 'numeric', 'exists:cad_atividade_comercial,id_atividade_comercial'],
            'cliente.celular' => ['required', 'string', 'regex:/^[0-9]+$/u', 'between:10,11'],
            'cliente.telefone' => ['string', 'regex:/^[0-9]+$/u', 'between:10,11', 'nullable'],
            'cliente.email' => ['required', 'string', 'email', 'between:0,50'],
            'cliente.cep' => ['required', 'string', 'regex:/^[0-9]+$/u', 'size:8'],
            'cliente.uf' => ['required', 'string', 'size:2', new Uf],
            'cliente.cidade' => ['required', 'string', 'between:0,50'],
            'cliente.bairro' => ['required', 'string', 'between:0,50'],
            'cliente.logradouro' => ['required', 'string', 'between:0,50'],
            'cliente.complemento' => ['string', 'nullable'],
            'cliente.numero' => ['required', 'numeric'],
            'cliente.id_tipo_logradouro' => ['required', 'numeric', 'exists:cad_tipo_logradouro,id_tipo_logradouro'],

            'cliente.tipo_empresa' => ['required', 'string'],
            'cliente.id_porte_empresa' => ['required', 'numeric', 'exists:cad_porte_empresa,id_porte_empresa'],
            'cliente.rendimento_mensal' => ['required', 'numeric', 'max:100000000'],
            'cliente.faturamento_anual' => ['required', 'numeric', 'max:100000000'],
            'cliente.capital_social' => ['required', 'numeric', 'max:100000000'],
            'cliente.ano_faturamento' => ['required', 'regex:/^[0-9]+$/u',  'size:4'],

            'socios.0.id_pessoa_assinatura' => ['required', 'regex:/^[0-9]+$/u', 'exists:cad_pessoa_assinatura,id_pessoa_assinatura'],
            'socios.0.nome' => ['required', 'string'],
            'socios.0.cpf' => ['required', 'regex:/^[0-9]+$/u', 'cpf'],
            'socios.0.data_nascimento' => ['required', 'date'],
            'socios.0.sexo' => ['required', 'string', 'size:1'],
            'socios.0.nome_mae' => ['required', 'string', 'between:0,50'],
            'socios.0.celular' => ['required', 'string', 'regex:/^[0-9]+$/u', 'between:10,11'],
            'socios.0.telefone' => ['string', 'regex:/^[0-9]+$/u', 'between:10,11', 'nullable'],
            'socios.0.email' => ['required', 'string', 'email', 'between:0,50'],
            'socios.0.cep' => ['required', 'string', 'regex:/^[0-9]+$/u', 'size:8'],
            'socios.0.uf' => ['required', 'string', 'size:2', new Uf],
            'socios.0.cidade' => ['required', 'string', 'between:0,50'],
            'socios.0.bairro' => ['required', 'string', 'between:0,50'],
            'socios.0.logradouro' => ['required', 'string', 'between:0,50'],
            'socios.0.id_tipo_logradouro' => ['required', 'numeric', 'exists:cad_tipo_logradouro,id_tipo_logradouro'],
            'socios.0.complemento' => ['string', 'between:0,50', 'nullable'],
            'socios.0.numero' => ['required', 'numeric'],
            'socios.0.renda_mensal' => ['required', 'numeric', 'max:100000000'],
            'socios.0.politicamente_exposto' => ['boolean'],
            'socios.0.parente_politicamente_exposto' => ['boolean'],
            'socios.0.cargo_politico' => ['string', 'nullable'],
            'socios.0.cargo_parente_politico' => ['string', 'nullable'],
            'socios.0.tipo_pessoa_assinatura' => ['required', 'numeric', 'nullable'],
            'socios.0.situacao_empregaticia' => ['string', 'nullable'],
            'socios.0.empresa_trab' => ['string', 'nullable'],
            'socios.0.estado_civil' => ['required', 'string'],
            'socios.0.numero_documento_identidade' => ['required', 'string', 'max:11'],
            'socios.0.uf_documento_identidade' => ['required', 'string'],
            'socios.0.tipo_documento_identidade' => ['required', 'string'],
        ];
    }
}
