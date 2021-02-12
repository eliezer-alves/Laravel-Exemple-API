<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Solicitacao;
use App\Models\Proposta;
use App\Models\DocumentoProposta;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitacaoSeeder extends Seeder
{
	private $id_cliente = 195;
	private $id_forma_inclusao_capital_de_giro = 7;

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
    	try{
    		DB::beginTransaction();
    		$obj_cliente = Cliente::Factory()->make();

    		dd($obj_cliente);

	        $obj_solicitacao = Solicitacao::factory()->make();
	        $obj_proposta = Proposta::factory()->make();
	        $obj_documento = DocumentoProposta::factory()->make();

	        $solicitacao = Solicitacao::create($obj_solicitacao->toArray());
	        $proposta = Proposta::create($obj_proposta->toArray());

	        $obj_documento->id_proposta = $proposta->id_proposta;
	        $documento = DocumentoProposta::create($obj_documento->toArray());

	        $solicitacao->id_proposta = $proposta->id_proposta;
	        $solicitacao->save();

	        DB::commit();
	    } catch (Exception $e){
	    	DB::rolback();
	    }
    }
}
