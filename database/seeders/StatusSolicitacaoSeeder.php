<?php

namespace Database\Seeders;

use App\Models\StatusSolicitacao;

use Illuminate\Database\Seeder;

class StatusSolicitacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_solicitacao = StatusSolicitacao::create([
        	'descricao' => 'PENDENTE ANALISE'
        ]);
    }
}
