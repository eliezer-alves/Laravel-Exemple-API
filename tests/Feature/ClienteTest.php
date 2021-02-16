<?php

namespace Tests\Feature;

use App\Models\Cliente;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    /** @test */
    public function check_if_cliente_columns_is_correct()
    {
        $expected =[ 
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
            'id_forma_inclusao',
            'createdAt',
            'updatedAt',
            'deletedAt'
        ];

        $cliente = new Cliente;

        $this->assertEquals(0, count(array_diff($expected, $cliente->getFillable())));
    }

    public function test_exemple()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
