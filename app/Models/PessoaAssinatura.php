<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaAssinatura extends Model
{
    use HasFactory;

    protected $table = 'cad_pessoa_assinatura';
    protected $primaryKey =  'id_pessoa_assinatura';

    protected $fillable = [
        'nome',
        'cpf',
        'cnpj',
        'celular',
        'email',
        'sexo',
        'cep',
        'cidade',
        'uf',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'created_at',
        'updated_at',
        'deleted_at',
        'tipo_pessoa_assinatura',
        'score',
        'restricao',
        'renda_mensal',
        'situacao_empregaticia',
        'empresa_trab',
        'data_nascimento',
        'token',
        'id_proposta',
        'data_validacao_token',
        'data_aceite_1',
        'data_aceite_2',
        'ip_cliente',
        'hash_assinatura',
        'celular_envio_sms',
        'email_envio_sms',
        'id_tipo_logradouro',
        'estado_civil',
        'numero_documento_identidade',
        'uf_documento_identidade',
        'tipo_documento_identidade'
    ];

    protected $attributes = [
        'nome' => null,
        'cpf' => null,
        'cnpj' => null,
        'celular' => null,
        'email' => null,
        'sexo' => null,
        'cep' => null,
        'cidade' => null,
        'uf' => null,
        'logradouro' => null,
        'numero' => null,
        'complemento' => null,
        'bairro' => null,
        'tipo_pessoa_assinatura' => null,
        'renda_mensal' => null,
        'situacao_empregaticia' => null,
        'empresa_trab' => null,
        'data_nascimento' => null,
        'id_tipo_logradouro' => null,
        'estado_civil' => null,
        'numero_documento_identidade' => null,
        'uf_documento_identidade' => null,
        'tipo_documento_identidade' => null
    ];
}
