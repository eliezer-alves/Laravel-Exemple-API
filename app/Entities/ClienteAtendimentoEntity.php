<?php

namespace App\Entities;

use App\Entities\Contracts\ClienteAtendimentoEntityInterface;

class ClienteAtendimentoEntity implements ClienteAtendimentoEntityInterface
{
    public $nome;
	public $cpf;
	public $rg;
	public $celular;
	public $email;
	public $data_nascimento;
	public $data_fundacao;
	public $sexo;
	public $nome_mae;
	public $cnpj;
	public $inscricao_estadual;
	public $nome_fantasia;
	public $razao_social;
	public $ramo_atividade;
	public $cep;
	public $cidade;
	public $uf;
	public $logradouro;
	public $numero;
	public $complemento;
	public $bairro;
	public $id_tipo_logradouro;
    public $id_atividade_comercial;
    public $socio_cpf;
    public $socio_nome;
    public $socio_cep;
    public $socio_uf;
    public $socio_cidade;
    public $socio_logradouro;
    public $socio_numero;
    public $socio_comlemento;
    public $socio_nome_mae;
    
    public function construct(array $data)
    {
        $this->hydrator($data);
    }

    public function hydrator($array)
    {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                if ($this->$key == NULL) {
                    $this->$key = $value;
                }
            }
        }
    }
}