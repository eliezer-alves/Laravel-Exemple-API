<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
            'cnpj' => ['regex:/^[0-9]+$/u', 'cnpj'],
            'nome_fantasia' => ['string'],
            'razao_social' => ['string'],
            'data_fundacao' => ['date'],
            'id_atividade_comercial' => ['numeric', 'exists:atividade_comercial,id'],
            'id_tipo_empresa' => ['numeric', 'exists:tipo_empresa,id'],
            'id_porte_empresa' => ['numeric', 'exists:porte_empresa,id'],
            'id_cosif' => ['numeric',  'exists:cosif,id'],
        ];
    }
}
