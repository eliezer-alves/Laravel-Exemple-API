<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModeloSicredRequest extends FormRequest
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
            'modelo' => ['string'],
            'empresa' => ['string'],
            'agencia' => ['string'],
            'loja' => ['string'],
            'lojista' => ['string'],
            'produto' => ['string'],
            'plano' => ['string'],
            'taxa' => ['numeric'],
        ];
    }

        /**
     * Get the error messages validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {        return [
            'modelo.string' => 'Campo modelo é do tipo texto.',
            'empresa.string' => 'Campo empresa é do tipo texto.',
            'agencia.string' => 'Campo agencia é do tipo texto.',
            'loja.string' => 'Campo loja obrigatório string',
            'lojista.string' => 'Campo lojista é do tipo texto.',
            'produto.string' => 'Campo produto é do tipo texto.',
            'plano.string' => 'Campo plano é do tipo texto.',
            'taxa.numeric' => 'Campo taxa é do tipo numérico.',
        ];
    }
}
