<?php

namespace Database\Seeders;

use App\Models\StatusSolicitacao;

use Illuminate\Database\Seeder;

class StatusSolicitacaoSeeder extends Seeder
{
    private $listaStatusSolicitacao = ['APROVADA', 'NEGADA', 'EM ANÁLISE', 'PENDENTE ANÁLISE'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->listaStatusSolicitacao as $status) {
            $r = StatusSolicitacao::create([
                'descricao' => $status
            ]);
        }
    }
}
