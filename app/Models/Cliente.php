<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AtividadeComercial;

class Cliente extends Model
{
	use HasFactory;

	protected $table = 'cad_cliente';
	protected $primaryKey =  'id_cliente';
	public $timestamps = false;

	protected $hidden = [
		'senha'
	];

	protected $fillable = [
		'nome',
		'cpf',
		'rg',
		'celular',
		'email',
		'data_nascimento',
		'data_fundacao',
		'sexo',
		'nome_mae',
		'cnpj',
		'inscricao_estadual',
		'nome_fantasia',
		'razao_social',
		'ramo_atividade',
		'cep',
		'cidade',
		'uf',
		'logradouro',
		'numero',
		'complemento',
		'bairro',
		'id_tipo_logradouro',
		'id_atividade_comercial',
		'createdAt',
		'updatedAt',
		'deletedAt'
	];

	public function solicitacaoes()
	{
		return $this->hasMany(Solicitacao::class);
	}

	public function propostas()
	{
		return $this->hasMany(Proposta::class);
	}

	public function atividadeComercial()
	{
		return $this->beloongsTo(AtividadeComercial::class, 'id_atividade_comercial');
	}
}
