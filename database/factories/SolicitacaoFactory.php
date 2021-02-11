<?php

namespace Database\Factories;

use App\Models\Solicitacao;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitacaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Solicitacao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_cliente' => 45,
            'valor_solicitado' => 100.00,
            'id_status_solicitacao' => 1,
            'id_motivo_finalizacao_solicitacao' => 1,
            'observacao' => $this->faker->realText($maxNbChars = 60)
        ];
    }
}
