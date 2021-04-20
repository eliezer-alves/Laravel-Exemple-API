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
            'cpf' => ['required', 'regex:/^[0-9]+$/u', 'between:11,14'],
            'dataPrimeiroVencimento' => ['required', 'date'],
            'prazo' => ['required', 'numeric', 'max:36'],
            'valorSolicitado' => ['required', 'numeric', 'max:1000000']
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
            'cpf.regex' => 'O campo CPF aceita somente caracteres do tipo numérico.',
            'cpf.between' => 'O campo CPF deve ter de 11 a 14 caracteres.',

            'dataPrimeiroVencimento.required' => 'O campo Data Primeiro Vencimento é obrigatório',
            'dataPrimeiroVencimento.date' => 'O campo Data Primeiro Vencimento tem que ser do tipo data.',

            'prazo.required' => 'O campo Prazo é obrigatório.',
            'prazo.numeric' => 'O campo Prazo tem que ser do tipo numérico.',
            'prazo.max' => 'O campo Prazo tem que ser menor ou igual a 36.',

            'valorSolicitado.required' => 'O campo Valor Solicitado é obrigatório.',
            'valorSolicitado.numeric' => 'O campo Valor Solicitado tem que ser do tipo numérico.',
            'valorSolicitado.max' => 'O campo Valor Solicitado tem que ser menor do que 1.000.000,00.',
        ];
    }
}
