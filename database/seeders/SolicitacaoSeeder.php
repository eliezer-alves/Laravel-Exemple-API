<?php

namespace Database\Seeders;

use App\Models\Solicitacao;

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

	        $solicitacao = Solicitacao::create([
	        	'id_cliente' => $this->id_cliente,
		    	'valor_solicitado' => 100.00,
		    	'id_status_solicitacao' => 1,
		    	'id_motivo_finalizacao' => 1,
		    	'observacao' => ''
	        ]);

	        $solicitacao->proposta->create([
	        	'contrato' => 1100377486,
				'estado_civil' => 'A',
				'renda' => 2000.00,
				'situacao_empregaticia' => '001',
				'descricao_empresa' => 'BRASILCARD',
				'valor_solicitado' => 2000.00,
				'nome_beneficiario' => 'DOUGLAS FERREIRA DA SILVA',
				'cpf_beneficiario' => '39950423848',
				'forma_liberacao' => '5',
				'valor_liberacao' => 1325.13,
				'banco_liberacao' => '001',
				'agencia_liberacao' => 1234,
				'digito_agencia_liberacao' => 1,
				'conta_liberacao' => 12345678,
				'digito_conta_liberacao' => 1,
				'tipo_conta' => '1',
				'tipo_documento_identidade' => '01',
				'uf_documento_identidade' => 'MG',
				'numero_documento_identidade' => '202173',
				'politicamente_exposto' => false,
				'cargo_politico' => '',
				'parente_politicamente_exposto' => false,
				'cargo_parente_politico' => '',
				'plano' => '0041',
				'data_solicitacao_proposta' => '2021-01-29 00:00:00',
				'id_cliente' => $this->id_cliente,
				'id_acesso_bio' => null,
				'id_status_administrativo' => 0,
				'cidade_geo' => null,
				'estado_geo' => null,
				'dados_completos_geo' => null,
				'valor_iof' => 26.78,
				'tac' => 50,
				'valor_financiado_total' => 1401.91,
				'valor_liquido_credito' => null,
				'valor_parcela' => 228.06,
				'quantidade_parcela' => 10,
				'taxa_juros_ano' => 213.5,
				'cet_mes' => 11.1366,
				'cet_ano' => 261.3500,
				'valor_seguro' => null,
				'data_geracao_proposta' => '2021-02-08 13:27:30',
				'data_geracao_contrato' => null,
				'data_remessa_contrato' => null,
				'data_aceite_1' => null,
				'data_aceite_2' => null,
				'hash_assinatura_ccb' => null,
				'data_visualizacao_proposta' => null,
				'taxa_juros_mes' => 9.9900,
				'id_forma_inclusao' => $this->id_forma_inclusao_capital_de_giro,
				'valor_total_a_pagar' => 2280.6,
				'valor_limite_liberado_bcard' => 1325.12
	        ]);
	        
	      //   $solicitacao->proposta->documentos->create([
		    	// 'id_usuario' => $this->id_cliente,
		    	// 'link' => '',
		    	// 'observacao' => 'OBSERVACAO TESTE',
		    	// 'id_status_documento' => 1
	      //   ]);

	        $solicitacao->id_proposta = $solicitacao->proposta->id_proposta;
	        $solicitacao->save();

	        DB::commit();
	    } catch (Exception $e){
	    	DB::rolback();
	    }
    }
}
