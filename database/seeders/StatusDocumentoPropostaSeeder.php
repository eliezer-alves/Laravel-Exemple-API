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
            	'descricao' => 'PENDENTE'
            ]);

            DB::commit();
        } catch (Exception $e){
            DB::rolback();
        }
    }
}
