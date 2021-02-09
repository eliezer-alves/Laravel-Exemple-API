<?php

namespace Database\Seeders;

use App\Models\MotivoFinalizacao;

use Illuminate\Database\Seeder;

class MotivoFinalizacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivo = MotivoFinalizacao::create([
        	'descricao' => 'NAO TENHO INTERESSE NO MOMENTO'
        ]);
    }
}
