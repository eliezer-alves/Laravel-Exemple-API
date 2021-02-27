<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimulacaoRequest extends FormRequest
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
            'cpf' => ['required', 'regex:/^[0-9]+$/u'],
            'dataPrimeiroVencimento' => ['required', 'date'],
            'prazo' => ['required', 'numeric'],
            'valorSolicitado' => ['required', 'numeric']
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
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.regex' => 'O campo CPF acita somente caracteres do tipo numérico.',

            'dataPrimeiroVencimento.required' => 'O campo Data Primeiro Vencimento é obrigatório',
            'dataPrimeiroVencimento.date' => 'O campo Data Primeiro Vencimento tem que ser do tipo data.',

            'prazo.required' => 'O campo Prazo é obrigatório.',
            'prazo.numeric' => 'O campo Prazo tem que ser do tipo numérico.',

            'valorSolicitado.required' => 'O campo Valor Solicitado é obrigatório.',
            'valorSolicitado.numeric' => 'O campo Valor Solicitado tem que ser do tipo numérico.',
        ];
    }
}
