<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientSicredRequest extends FormRequest
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
            'environment' => ['required', 'string'],
            'grant_type' => ['required', 'string'],
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'client_id' => ['required', 'string'],
            'client_secret' => ['required', 'string'],
            'scope' => ['required', 'string'],
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
            'environment.required'=> 'Campo Environment obrigatório.',
            'environment.string'=> 'Campo Environment é do tipo texte.',

            'grant_type.required'=> 'Campo Grant Type obrigatório.',
            'grant_type.string'=> 'Campo Grant Type é do tipo texte.',

            'username.required'=> 'Campo Username obrigatório.',
            'username.string'=> 'Campo Username é do tipo texte.',

            'password.required'=> 'Campo Password obrigatório.',
            'password.string'=> 'Campo Password é do tipo texte.',

            'client_id.required'=> 'Campo Client Id obrigatório.',
            'client_id.string'=> 'Campo Client Id é do tipo texte.',

            'client_secret.required'=> 'Campo Client Secret obrigatório.',
            'client_secret.string'=> 'Campo Client Secret é do tipo texte.',

            'scope.required'=> 'Campo Scope obrigatório.',
            'scope.string'=> 'Campo Scope é do tipo texte.',
        ];
    }
}
