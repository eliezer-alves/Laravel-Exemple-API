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
            'valorSolicitado' => ['required', 'numeric', 'max:1000000'],
            'taxa' => ['numeric', 'max:100'],
            'valorTAC' => ['numeric', 'between:100,5000', 'nullable']
        ];
    }
}
