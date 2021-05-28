<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Cliente;
use App\Models\Solicitacao;
use App\Models\Proposta;
use App\Models\DocumentoProposta;

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
		try {
			DB::beginTransaction();
			$obj_cliente = Cliente::Factory()->make();

			$objSolicitacao = Solicitacao::factory()->make();
			$objProposta = Proposta::factory()->make();
			$objDocumento = DocumentoProposta::factory()->make();

			$solicitacao = Solicitacao::create($objSolicitacao->toArray());
			$proposta = Proposta::create($objProposta->toArray());

			$objDocumento->id_proposta = $proposta->id_proposta;
			$documento = DocumentoProposta::create($objDocumento->toArray());

			$solicitacao->id_proposta = $proposta->id_proposta;
			$solicitacao->save();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
            throw $e;
		}
	}
}
