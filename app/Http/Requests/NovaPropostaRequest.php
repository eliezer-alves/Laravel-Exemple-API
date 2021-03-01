<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NovaPropostaRequest extends FormRequest
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
            'idSimulacao' => ['required', 'regex:/^[0-9]+$/u']
        ];
    }

    /**
     * Get the error messages from the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'idSimulacao.required' => 'O campo Id Proposta é obrigatório.',
            'idSimulacao.regex' => 'O campo Id Proposta aceita somente caracteres do tipo numérico.',
        ];
    }
}
