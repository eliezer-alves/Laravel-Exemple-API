<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalisePropostaConsultaRequest extends FormRequest
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
            'id_analise_proposta' => ['required', 'numeric', 'exists:cad_analise_proposta,id_analise_proposta'],
            'id_pessoa_assinatura' => ['required', 'numeric', 'exists:cad_pessoa_assinatura,id_pessoa_assinatura'],
        ];
    }
}
