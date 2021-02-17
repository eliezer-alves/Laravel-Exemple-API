<?php

namespace Database\Seeders;

use \App\Models\StatusDocumentoProposta;

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
        foreach ($this->listaStatusDocumento as $status) {
            $r = StatusDocumentoProposta::create([
                'descricao' => $status
            ]);
        }
    }
}
