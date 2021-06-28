<?php

namespace App\Http\Requests;

use App\Rules\Uf;
use Illuminate\Foundation\Http\FormRequest;

class NovaPropostaPJRequest extends FormRequest
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
            // 'teste' => ['required'],
            'proposta.id_simulacao' => ['required', 'numeric'],
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
            'cliente.tipo_imovel' => ['required', 'string'],

            'cliente.id_tipo_empresa' => ['required', 'numeric', 'exists:cad_tipo_empresa,id_tipo_empresa'],
            'cliente.id_porte_empresa' => ['required', 'numeric', 'exists:cad_porte_empresa,id_porte_empresa'],
            'cliente.rendimento_mensal' => ['required', 'numeric', 'max:100000000'],
            'cliente.faturamento_anual' => ['required', 'numeric', 'max:100000000'],
            'cliente.capital_social' => ['required', 'numeric', 'max:100000000'],
            'cliente.ano_faturamento' => ['required', 'regex:/^[0-9]+$/u',  'size:4'],
            'cliente.id_cosif' => ['required', 'regex:/^[0-9]+$/u',  'exists:cad_cosif,id_cosif'],

            'socios.*.nome' => ['string'],
            'socios.*.cpf' => ['regex:/^[0-9]+$/u', 'cpf'],
            'socios.*.data_nascimento' => ['date'],
            'socios.*.sexo' => ['string', 'size:1'],
            'socios.*.nome_mae' => ['string', 'between:0,50'],
            'socios.*.celular' => ['string', 'regex:/^[0-9]+$/u', 'between:10,11'],
            'socios.*.telefone' => ['string', 'regex:/^[0-9]+$/u', 'between:10,11', 'nullable'],
            'socios.*.email' => ['string', 'email', 'between:0,50'],
            'socios.*.cep' => ['string', 'regex:/^[0-9]+$/u', 'size:8'],
            'socios.*.uf' => ['string', 'size:2', new Uf],
            'socios.*.cidade' => ['string', 'between:0,50'],
            'socios.*.bairro' => ['string', 'between:0,50'],
            'socios.*.logradouro' => ['string', 'between:0,50'],
            'socios.*.id_tipo_logradouro' => ['numeric', 'exists:cad_tipo_logradouro,id_tipo_logradouro'],
            'socios.*.complemento' => ['string', 'between:0,50', 'nullable'],
            'socios.*.numero' => ['numeric'],
            'socios.*.renda_mensal' => ['numeric', 'max:100000000'],
            'socios.*.politicamente_exposto' => ['boolean'],
            'socios.*.parente_politicamente_exposto' => ['boolean'],
            'socios.*.cargo_politico' => ['string', 'nullable'],
            'socios.*.cargo_parente_politico' => ['string', 'nullable'],
            'socios.*.tipo_pessoa_assinatura' => ['numeric'],
            'socios.*.situacao_empregaticia' => ['string', 'required'],
            'socios.*.empresa_trab' => ['string', 'nullable'],
            'socios.*.estado_civil' => ['string'],
            'socios.*.numero_documento_identidade' => ['string', 'max:11'],
            'socios.*.uf_documento_identidade' => ['string'],
            'socios.*.tipo_documento_identidade' => ['string'],

            'socios.0.nome' => ['required'],
            'socios.0.cpf' => ['required'],
            'socios.0.data_nascimento' => ['required'],
            'socios.0.sexo' => ['required'],
            'socios.0.nome_mae' => ['required'],
            'socios.0.celular' => ['required'],
            'socios.0.email' => ['required'],
            'socios.0.cep' => ['required'],
            'socios.0.uf' => ['required'],
            'socios.0.cidade' => ['required'],
            'socios.0.bairro' => ['required'],
            'socios.0.logradouro' => ['required'],
            'socios.0.id_tipo_logradouro' => ['required'],
            'socios.0.numero' => ['required'],
            'socios.0.renda_mensal' => ['required'],
            'socios.0.tipo_pessoa_assinatura' => ['required'],
            'socios.0.estado_civil' => ['required'],
            'socios.0.numero_documento_identidade' => ['required'],
            'socios.0.uf_documento_identidade' => ['required'],
            'socios.0.tipo_documento_identidade' => ['required']
        ];
    }

    /**
     * Get the error messages from the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
