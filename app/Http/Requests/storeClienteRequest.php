<?php

namespace App\Http\Requests;

use App\Rules\Uf;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'cnpj' => ['required', 'regex:/^[0-9]+$/u', 'unique:cad_cliente,cnpj', 'string', 'cnpj'],
            'inscricao_estadual' => 'required',
            'nome_fantasia' => ['required', 'string'],
            'razao_social' => ['required', 'string'],
            'celular' => ['required', 'string', 'regex:/^[0-9]+$/u', 'between:10,11'],
            'email' => ['required', 'string', 'email', 'confirmed'],
            'senha' => ['required', 'string', 'between:6,12', 'confirmed'],
            'cep' => ['required', 'string', 'regex:/^[0-9]+$/u', 'size:7'],
            'uf' => ['required', 'string', 'size:2', new Uf],
            'cidade' => ['required', 'string'],
            'bairro' => ['required', 'string'],
            'logradouro' => ['required', 'string'],
            'numero' => ['required', 'numeric'],
            'id_atividade_comercial' => ['required', 'numeric'],
            'id_tipo_logradouro' => ['required', 'numeric']
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
            'cnpj.required' => 'O campo cnpj é obrigatório.',
            'cnpj.unique' => 'cnpj já cadastrado.',
            'cnpj.string' => 'O campo cnpj é do tipo texto.',
            'cnpj.regex' => 'O campo cnpj no formato inválido.',

            'inscricao_estadual.required' => 'O campo inscricao_estadual é obrigatório.',
            'inscricao_estadual.string' => 'O campo inscricao_estadual é do tipo texto.',

            'nome_fantasia.required' => 'O campo nome_fantasia é obrigatório.',
            'nome_fantasia.string' => 'O campo nome_fantasia é do tipo texto.',

            'razao_social.required' => 'O campo razao_social é obrigatório.',
            'razao_social.string' => 'O campo razao_social é do tipo texto.',

            'celular.required' => 'O campo celular é obrigatório.',
            'celular.string' => 'O campo celular é do tipo texto.',
            'celular.between' => 'O campo celular está com formato inválido.',

            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email é do tipo texto.',
            'email.email' => 'O campo email deve conter um endereço de email válido.',
            'email.confirmed' => 'Confirmação de email inválida.',

            'senha.required' => 'O campo senha é obrigatório.',
            'senha.string' => 'O campo senha é do tipo texto.',
            'senha.between' => 'O campo senha deve conter de 8 à 12 caracteres.',
            'senha.confirmed' => 'Confirmação de senha inválida.',

            'cep.required' => 'O campo cep é obrigatório.',
            'cep.string' => 'O campo cep é do tipo texto.',
            'cep.regex' => 'O campo com formato inválido.',
            'cep.size' => 'O campo com formato inválido.',

            'uf.required' => 'O campo uf é obrigatório.',
            'uf.string' => 'O campo uf é do tipo texto.',
            'uf.size' => 'O campo uf deve possuir 2 caracteres.',

            'cidade.required' => 'O campo cidade é obrigatório.',
            'cidade.string' => 'O campo cidade é do tipo texto.',

            'bairro.required' => 'O campo bairro é obrigatório.',
            'bairro.string' => 'O campo bairro é do tipo texto.',

            'logradouro.required' => 'O campo logradouro é obrigatório.',
            'logradouro.string' => 'O campo logradouro é do tipo texto.',

            'numero.required' => 'O campo numero é obrigatório.',
            'numero.numeric' => 'O campo numero é do tipo numérico.',

            'id_atividade_comercial.required' => 'O campo id_atividade_comercial é obrigatório.',
            'id_atividade_comercial.numeric' => 'O campo id_atividade_comercial é do tipo numérico.',

            'id_tipo_logradouro.required' => 'O campo id_tipo_logradouro é obrigatório.',
            'id_tipo_logradouro.numeric' => 'O campo id_tipo_logradouro é do tipo numérico.'
        ];
    }
}
