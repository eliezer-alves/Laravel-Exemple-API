<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaAssinatura extends Model
{
    use HasFactory;

    protected $table = 'cad_pessoa_assinatura';
    protected $primaryKey =  'id_pessoa_assinatura';

    $fillable = [
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
		'id_tipo_logradouro'
    ];
}
