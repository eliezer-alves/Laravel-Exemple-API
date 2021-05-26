<?php

namespace Database\Seeders;

use App\Models\StatusSolicitacao;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
            foreach ($this->listaStatusSolicitacao as $status) {
                $r = StatusSolicitacao::create([
                    'descricao' => $status
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rolback();
        }
    }
}
