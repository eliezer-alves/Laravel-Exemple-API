<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;
    private $id_forma_inclusao_capital_de_giro = 7;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'cnpj' => $this->faker->cnpj(false),
            'inscricao_estadual' => $this->faker->rg(false),
            'nome_fantasia' => $this->faker->company,
            'razao_social' => $this->faker->company,
            'celular' => preg_replace('/[^0-9]+/', '', $this->faker->cellphone),
            'email' => $this->faker->email,
            'senha' => $this->faker->password(4, 4),
            'cep' => '5436094',//$this->faker->postcode,
            'uf' => $this->faker->stateAbbr,
            'cidade' => $this->faker->city,
            'bairro' => $this->faker->city,
            'logradouro' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'id_tipo_logradouro' => 1,
            'id_atividade_comercial' => 1,
            'id_forma_inclusao' => $this->id_forma_inclusao_capital_de_giro,
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
    }
}
