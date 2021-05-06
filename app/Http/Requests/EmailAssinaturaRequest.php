<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailAssinaturaRequest extends FormRequest
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
            'idProposta' => ['required', 'regex:/^[0-9]+$/u'],
            'idPessoaAssinatura' => ['required', 'regex:/^[0-9]+$/u'],
            'destinatario' => ['required', 'email'],
        ];
    }
}
