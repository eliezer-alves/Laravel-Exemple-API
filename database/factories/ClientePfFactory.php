<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientePfFactory extends Factory
{
    private $id_forma_inclusao_capital_de_giro = 7;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->firstName().' '.$this->faker->lastName(),
            'cpf' => $this->faker->unique()->cpf(false),
            'rg' => $this->faker->rg(false),
            'celular' => preg_replace('/[^0-9]+/', '', $this->faker->cellphone),
            'email' => $this->faker->email,
            'senha' => $this->faker->password(6, 8),
            'data_nascimento' => $this->faker->dateTimeBetween('-80 years', '-20 years')->format('Y-m-d'),
            'sexo' => array_rand(['M', 'F']),
            'nome_mae' => $this->faker->firstNameFemale.' '.$this->faker->lastName,
            'cep' => $this->faker->postcode,
            'uf' => $this->faker->stateAbbr,
            'cidade' => $this->faker->city,
            'bairro' => $this->faker->cityPrefix,
            'logradouro' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'complemento' => $this->faker->streetSuffix,
            'id_tipo_logradouro' => 1,
            'id_forma_inclusao' => $this->id_forma_inclusao_capital_de_giro,
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
    }
}
