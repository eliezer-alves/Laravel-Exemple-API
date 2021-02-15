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
            'cnpj' => ['required', 'string', 'cnpj', 'formato_cnpj'],
            'inscricao_estadual' => 'required',
            'nome_fantasia' => ['required', 'string'],
            'razao_social' => ['required', 'string'],
            'ramo_atividade' => ['required', 'string'],
            'celular' => ['required', 'string', 'celular_com_ddd'],
            'email' => ['required', 'string', 'email', 'confirmed'],
            'senha' => ['required', 'string', 'between:6,12', 'confirmed'],
            'cep' => ['required', 'string', 'formato_cep'],
            'uf' => ['required', 'string', 'size:2', new Uf],
            'cidade' => ['required', 'string'],
            'bairro' => ['required', 'string'],
            'logradouro' => ['required', 'string'],
            'numero' => ['required', 'numeric'],
            'id_tipo_logradouro' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'cnpj.required' => 'O campo cnpj é obrigatório.',
            'cnpj.string' => 'O campo cnpj é do tipo string.',

            'inscricao_estadual.required' => 'O campo inscricao_estadual é obrigatório.',
            'inscricao_estadual.string' => 'O campo inscricao_estadual é do tipo string.',

            'nome_fantasia.required' => 'O campo nome_fantasia é obrigatório.',
            'nome_fantasia.string' => 'O campo nome_fantasia é do tipo string.',

            'razao_social.required' => 'O campo razao_social é obrigatório.',
            'razao_social.string' => 'O campo razao_social é do tipo string.',

            'ramo_atividade.required' => 'O campo ramo_atividade é obrigatório.',
            'ramo_atividade.string' => 'O campo ramo_atividade é do tipo string.',

            'celular.required' => 'O campo celular é obrigatório.',
            'celular.string' => 'O campo celular é do tipo string.',

            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email é do tipo string.',
            'email.email' => 'O campo email deve conter um endereço de email válido.',
            'email.confirmed' => 'Confirmação de email inválida.',

            'senha.required' => 'O campo senha é obrigatório.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.string' => 'O campo senha é do tipo string.',
            'senha.between' => 'O campo senha deve conter de 8 à 12 caracteres.',
            'senha.confirmed' => 'Confirmação de senha inválida.',

            'cep.required' => 'O campo cep é obrigatório.',
            'cep.string' => 'O campo cep é do tipo string.',

            'uf.required' => 'O campo uf é obrigatório.',
            'uf.string' => 'O campo uf é do tipo string.',
            'uf.size' => 'O campo uf deve possuir 2 caracteres.',

            'cidade.required' => 'O campo cidade é obrigatório.',
            'cidade.string' => 'O campo cidade é do tipo string.',

            'bairro.required' => 'O campo bairro é obrigatório.',
            'bairro.string' => 'O campo bairro é do tipo string.',

            'logradouro.required' => 'O campo logradouro é obrigatório.',
            'logradouro.string' => 'O campo logradouro é do tipo string.',

            'numero.required' => 'O campo numero é obrigatório.',
            'numero.numeric' => 'O campo numero é do tipo numeric.',

            'id_tipo_logradouro.required' => 'O campo id_tipo_logradouro é obrigatório.',
            'id_tipo_logradouro.numeric' => 'O campo id_tipo_logradouro é do tipo numeric.'
        ];
    }
}
