<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConcluirAnalisePropostaRequest extends FormRequest
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
            'id_status_analise_proposta' => ['required', 'numeric', 'exists:cad_status_analise_proposta,id_status_analise_proposta'],
            'valor_aprovado' => ['required', 'numeric', 'between:0,1000000'],

            'cliente.id_pessoa_assinatura' => ['required', 'numeric', 'exists:cad_pessoa_assinatura,id_pessoa_assinatura'],
            'cliente.id_confirme_online' => ['required', 'numeric'],
            'cliente.id_score' => ['numeric'],
            'cliente.restricao' => ['numeric'],
            'cliente.score' => ['numeric'],

            'representante.id_pessoa_assinatura' => ['required', 'numeric', 'exists:cad_pessoa_assinatura,id_pessoa_assinatura'],
            'representante.id_scpc' => ['required', 'numeric'],
            'representante.id_spc_brasil' => ['required', 'numeric'],
            'representante.id_info_mais' => ['required', 'numeric'],
            'representante.id_confirme_online' => ['required', 'numeric'],
            'representante.id_score' => ['numeric'],
            'representante.restricao' => ['numeric'],
            'representante.score' => ['numeric'],

            'socios.0.id_pessoa_assinatura' => ['required', 'numeric', 'exists:cad_pessoa_assinatura,id_pessoa_assinatura'],
            'socios.0.id_scpc' => ['required', 'numeric'],
            'socios.0.id_spc_brasil' => ['required', 'numeric'],
            'socios.0.id_info_mais' => ['required', 'numeric'],
            'socios.0.id_confirme_online' => ['required', 'numeric'],
            'socios.0.id_score' => ['numeric'],
            'socios.0.restricao' => ['numeric'],
            'socios.0.score' => ['numeric'],
        ];

    }
}
