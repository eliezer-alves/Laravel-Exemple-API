<?php

namespace Database\Seeders;

use \App\Models\StatusDocumentoProposta;

use Illuminate\Database\Seeder;

class StatusDocumentoPropostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_documento = StatusDocumentoProposta::create([
        	'descricao' => 'EM ANALISE'
        ]);
    }
}
