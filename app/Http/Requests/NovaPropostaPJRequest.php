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
            'proposta.idSimulacao' => ['required', 'numeric'],
            'proposta.valor_solicitado' => ['required', 'numeric'],
            'proposta.primeiro_vencimento' => ['required', 'date'],
            'proposta.forma_liberacao' => ['required', 'string'],
            'proposta.banco_liberacao' => ['required', 'string'],
            'proposta.agencia_liberacao' => ['required', 'numeric'],
            'proposta.digito_agencia_liberacao' => ['required', 'numeric'],
            'proposta.conta_liberacao' => ['required', 'numeric'],
            'proposta.digito_conta_liberacao' => ['required', 'numeric'],
            'proposta.tipo_conta' => ['required'],
            'proposta.quantidade_parcela' => ['required', 'numeric'],

            'cliente.cnpj' => ['required', 'regex:/^[0-9]+$/u', 'cnpj'],
            'cliente.nome_fantasia' => ['required', 'string'],
            'cliente.razao_social' => ['required', 'string'],
            'cliente.inscricao_estadual' => ['required', 'numeric'],
            'cliente.data_fundacao' => ['required', 'date'],
            'cliente.id_atividade_comercial' => ['required', 'numeric'],
            'cliente.celular' => ['required', 'string', 'regex:/^[0-9]+$/u', 'between:10,11'],
            'cliente.email' => ['required', 'string', 'email'],
            'cliente.cep' => ['required', 'string', 'regex:/^[0-9]+$/u', 'size:8'],
            'cliente.uf' => ['required', 'string', 'size:2', new Uf],
            'cliente.cidade' => ['required', 'string'],
            'cliente.bairro' => ['required', 'string'],
            'cliente.logradouro' => ['required', 'string'],
            'cliente.complemento' => ['string', 'nullable'],
            'cliente.numero' => ['required', 'numeric'],
            'cliente.id_tipo_logradouro' => ['required', 'numeric'],

            'socios.0.nome' => ['required', 'string'],
            'socios.0.cpf' => ['required', 'regex:/^[0-9]+$/u', 'cpf'],
            'socios.0.rg' => ['required', 'string'],
            'socios.0.data_nascimento' => ['required', 'date'],
            'socios.0.sexo' => ['required', 'string'],
            'socios.0.nome_mae' => ['required', 'string'],
            'socios.0.celular' => ['required', 'string', 'regex:/^[0-9]+$/u', 'between:10,11'],
            'socios.0.email' => ['required', 'string', 'email'],
            'socios.0.cep' => ['required', 'string', 'regex:/^[0-9]+$/u', 'size:8'],
            'socios.0.uf' => ['required', 'string', 'size:2', new Uf],
            'socios.0.cidade' => ['required', 'string'],
            'socios.0.bairro' => ['required', 'string'],
            'socios.0.logradouro' => ['required', 'string'],
            'socios.0.id_tipo_logradouro' => ['required', 'numeric'],
            'socios.0.complemento' => ['string', 'nullable'],
            'socios.0.numero' => ['required', 'numeric'],
            'socios.0.renda_mensal' => ['required', 'numeric'],
            'socios.0.politicamente_exposto' => ['boolean'],
            'socios.0.parente_politicamente_exposto' => ['boolean'],
            'socios.0.cargo_politico' => ['string', 'nullable'],
            'socios.0.cargo_parente_politico' => ['string', 'nullable'],
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
