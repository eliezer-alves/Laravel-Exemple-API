<?php

namespace Database\Factories;

use App\Models\ConfiguracaoSicred;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfiguracaoSicredFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConfiguracaoSicred::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'batch' => 'hml',
            'grant_type' => 'password',
            'username' => 'master',
            'password' => 'MASTER123',
            'client_id' => 'sicred-client',
            'client_secret' => '49e8a585-3785-42ca-b4da-a10b6300776f',
            'scope' => 'sicred.usuario',
        ];
    }
}
