<?php

namespace App\Http\Requests;

use App\Rules\Uf;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
            'cnpj' => ['regex:/^[0-9]+$/u', 'string', 'cnpj'],
            'nome_fantasia' => ['string'],
            'razao_social' => ['string'],
            'ramo_atividade' => ['numeric'],
            'celular' => ['string', 'celular_com_ddd'],
            'email' => ['string', 'email', 'confirmed'],
            'senha' => ['string', 'between:6,12', 'confirmed'],
            'cep' => ['string', 'formato_cep'],
            'uf' => ['string', 'size:2', new Uf],
            'cidade' => ['string'],
            'bairro' => ['string'],
            'logradouro' => ['string'],
            'numero' => ['numeric'],
            'id_tipo_logradouro' => ['numeric']
        ];
    }

    public function messages()
    {
        return [
            'cnpj.string' => 'O campo cnpj é do tipo texto.',
            'cnpj.string' => 'O campo cnpj é do tipo texto.',
            'cnpj.regex' => 'O campo cnpj no formato inválido.',

            'nome_fantasia.string' => 'O campo nome_fantasia é do tipo texto.',

            'razao_social.string' => 'O campo razao_social é do tipo texto.',

            'ramo_atividade.numeric' => 'O campo ramo_atividade é do tipo numérico.',

            'celular.string' => 'O campo celular é do tipo texto.',

            'email.string' => 'O campo email é do tipo texto.',
            'email.email' => 'O campo email deve conter um endereço de email válido.',
            'email.confirmed' => 'Confirmação de email inválida.',

            'senha.string' => 'O campo senha é do tipo texto.',
            'senha.between' => 'O campo senha deve conter de 8 à 12 caracteres.',
            'senha.confirmed' => 'Confirmação de senha inválida.',

            'cep.string' => 'O campo cep é do tipo texto.',

            'uf.string' => 'O campo uf é do tipo texto.',
            'uf.size' => 'O campo uf deve possuir 2 caracteres.',

            'cidade.string' => 'O campo cidade é do tipo texto.',

            'bairro.string' => 'O campo bairro é do tipo texto.',

            'logradouro.string' => 'O campo logradouro é do tipo texto.',

            'numero.numeric' => 'O campo numero é do tipo numérico.',

            'id_tipo_logradouro.numeric' => 'O campo id_tipo_logradouro é do tipo numérico.'
        ];
    }
}
