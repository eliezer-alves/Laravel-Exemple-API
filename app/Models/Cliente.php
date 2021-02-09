<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cad_cliente';
    protected $primaryKey =  'id_cliente';

    $fillable = [
		'nome',
		'cpf',
		'rg',
		'celular',
		'email',
		'senha',
		'data_nascimento',
		'sexo',
		'nome_mae',
		'cep',
		'cidade',
		'uf',
		'logradouro',
		'numero',
		'complemento',
		'bairro',
		'createdAt',
		'updatedAt',
		'deletedAt',
		'id_tipo_logradouro',
		'id_forma_inclusao'
    ];

    public function solicitacaoes()
    {
        return $this->hasMany(Solicitacao::class);
    }

    public function propostas()
    {
        return $this->hasMany(Proposta::class);
    }
}
