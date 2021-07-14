<?php

namespace App\Http\Requests;

use App\Rules\Uf;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
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
            'cnpj' => ['required', 'regex:/^[0-9]+$/u', 'unique:empresa,cnpj', 'cnpj'],
            'inscricao_estadual' => 'required',
            'nome_fantasia' => ['required', 'string'],
            'razao_social' => ['required', 'string'],
            'data_fundacao' => ['required', 'date'],
            'id_atividade_comercial' => ['required', 'numeric', 'exists:atividade_comercial,id'],
            'id_tipo_empresa' => ['required', 'numeric', 'exists:tipo_empresa,id'],
            'id_porte_empresa' => ['required', 'numeric', 'exists:porte_empresa,id'],
            'id_cosif' => ['required', 'numeric',  'exists:cosif,id'],
        ];
    }
}
