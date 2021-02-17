<?php

namespace Database\Factories;

use App\Models\AtividadeComercial;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtividadeComercialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AtividadeComercial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'atividade' => 'TESTE'
        ];
    }
}
