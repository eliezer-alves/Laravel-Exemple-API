<?php

namespace Database\Factories;

use App\Models\DocumentoProposta;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoPropostaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentoProposta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [            
            'id_usuario' => 45,
            'link' => $this->faker->url,
            'observacao' => $this->faker->realText($maxNbChars = 60),
            'id_status_documento_proposta' => 1
        ];
    }
}
