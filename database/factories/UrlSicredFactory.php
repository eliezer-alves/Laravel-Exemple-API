<?php

namespace Database\Factories;

use App\Models\UrlSicred;
use Illuminate\Database\Eloquent\Factories\Factory;

class UrlSicredFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UrlSicred::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'base_url' => 'https://sicred-api-hml.agil.com.br',
            'athentication_url' => '/auth/connect/token',
            'simulacao_url' => '/simulacao/api/simulacao',
            'proposta_url' => '/propostas/api/Proposta',
            'proposta_v2_url' => '/propostas/api/v2/Proposta',
            'contrato_url' => '/contratos/api/contrato',
            'contrato_v2_url' => '/contratos/api/v2/contrato',
            'dominios_url' => '/dominios/api'
        ];
    }
}
