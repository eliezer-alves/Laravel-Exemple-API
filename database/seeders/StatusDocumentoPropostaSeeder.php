<?php

namespace Database\Seeders;

use \App\Models\StatusDocumentoProposta;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusDocumentoPropostaSeeder extends Seeder
{
    private $listaStatusDocumento = ['APROVADO', 'NEGADO', 'EM ANÁLISE', 'PENDENTE ANÁLISE'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            foreach ($this->listaStatusDocumento as $status) {
                StatusDocumentoProposta::create([
                    'descricao' => $status
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
