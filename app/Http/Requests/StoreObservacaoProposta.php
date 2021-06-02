<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObservacaoProposta extends FormRequest
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
            'observacao' => ['required', 'string'],
            'id_proposta' => ['required', 'numeric', 'exists:cad_proposta,id_proposta'],
            'id_usuario' => ['required', 'numeric', 'exists:cad_usuario,id_usuario'],
        ];
    }
}
