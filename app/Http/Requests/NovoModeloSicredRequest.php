<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NovoModeloSicredRequest extends FormRequest
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
            'modelo' => ['required', 'string'],
            'empresa' => ['required', 'string'],
            'agencia' => ['required', 'string'],
            'loja' => ['required', 'string'],
            'lojista' => ['required', 'string'],
            'produto' => ['required', 'string'],
            'plano' => ['required', 'string'],
            'taxa' => ['required', 'numeric'],
            'id_client_sicred' => ['required', 'string'],
        ];
    }

        /**
     * Get the error messages validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'modelo.required' => 'Campo modelo obrigatório.',
            'modelo.string' => 'Campo modelo é do tipo texto.',

            'empresa.required' => 'Campo empresa obrigatório.',
            'empresa.string' => 'Campo empresa é do tipo texto.',

            'agencia.required' => 'Campo agencia obrigatório.',
            'agencia.string' => 'Campo agencia é do tipo texto.',

            'loja.required' => 'Campo loja obrigatório',
            'loja.string' => 'Campo loja obrigatório string',

            'lojista.required' => 'Campo lojista obrigatório',
            'lojista.string' => 'Campo lojista é do tipo texto.',

            'produto.required' => 'Campo produto obrigatório',
            'produto.string' => 'Campo produto é do tipo texto.',

            'plano.required' => 'Campo plano obrigatório',
            'plano.string' => 'Campo plano é do tipo texto.',

            'taxa.required' => 'Campo taxa obrigatório',
            'taxa.numeric' => 'Campo taxa é do tipo numérico.',

            'id_client_sicred.required' => 'Campo id_client_sicred obrigatório',
            'id_client_sicred.string' => 'Campo id_client_sicred é do tipo texto.',
        ];
    }
}
