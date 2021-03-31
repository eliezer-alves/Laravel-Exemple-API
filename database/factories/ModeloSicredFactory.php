<?php

namespace Database\Factories;

use App\Models\ModeloSicred;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModeloSicredFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModeloSicred::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'modelo' => 'capital-de-giro',
            'empresa' => '01',
            'agencia' => '0001',
            'loja' => '0001',
            'lojista' => '000001',
            'cosif' => '43000',
            'produto' => '000078',
            'plano' => '0050',
            'taxa' => 9.99
        ];
    }
}
