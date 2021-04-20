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
        'telefone',
        'email',
        'data_nascimento',
        'data_fundacao',
        'sexo',
        'nome_mae',
        'cnpj',
        'inscricao_estadual',
        'nome_fantasia',
        'razao_social',
        'cep',
        'cidade',
        'uf',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'id_tipo_logradouro',
        'id_atividade_comercial',
        'tipo_empresa',
        'porte',
        'rendimento_mensal',
        'faturamento_anual',
        'capital_social',
        'ano_faturamento',
        'createdAt',
        'updatedAt',
        'deletedAt',
    ];

    protected $attributes = [
        'nome' => null,
        'cpf' => null,
        'rg' => null,
        'celular' => null,
        'telefone' => null,
        'email' => null,
        'data_nascimento' => null,
        'data_fundacao' => null,
        'sexo' => null,
        'nome_mae' => null,
        'cnpj' => null,
        'inscricao_estadual' => null,
        'nome_fantasia' => null,
        'razao_social' => null,
        'cep' => null,
        'cidade' => null,
        'uf' => null,
        'logradouro' => null,
        'numero' => null,
        'complemento' => null,
        'bairro' => null,
        'id_tipo_logradouro' => null,
        'id_atividade_comercial' => null,
        'tipo_empresa' => null,
        'porte' => null,
        'rendimento_mensal' => null,
        'faturamento_anual' => null,
        'capital_social' => null,
        'ano_faturamento' => null,
    ];

    public function solicitacaoes()
    {
        return $this->hasMany(Solicitacao::class);
    }

    public function propostas()
    {
        return $this->hasMany(Proposta::class, 'id_cliente', 'id_cliente');
    }

    public function atividadeComercial()
    {
        return $this->belongsTo(AtividadeComercial::class, 'id_atividade_comercial');
    }
}
