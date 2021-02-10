<?php

namespace Database\Seeders;

use \App\Models\StatusDocumentoProposta;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusDocumentoPropostaSeeder extends Seeder
{
    private $id_cliente = 195;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            DB::beginTransaction();
            $status_documento = StatusDocumentoProposta::create([
            	'descricao' => 'APAGAR'
            ]);

            $status_documento->documentos->create([
                'id_usuario' => $this->id_cliente,
                'link' => '',
                'observacao' => 'OBSERVACAO TESTE',
                'id_status_documento' => 1
            ]);

            DB::commit();
        } catch (Exception $e){
            DB::rolback();
        }
    }
}
