<?php

namespace Database\Seeders;

use App\Models\MotivoFinalizacao;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoFinalizacaoSeeder extends Seeder
{
    private $listaMotivoFinalizacao = ['NAO CONCORDO COM AS TAXAS DE JUROS', 'NAO PRECISO DE EMPRESTIMO NO MOMENTO', 'NAO TENHO INTERESSE', 'VOU PENSAR NA PROPOSTA', 'OUTROS'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            foreach ($this->listaMotivoFinalizacao as $motivo) {
                $r = MotivoFinalizacao::create([
                    'descricao' => $motivo
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
