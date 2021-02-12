<?php

namespace Database\Factories;

use App\Models\Proposta;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropostaFactory extends Factory
{
    private $id_cliente = 195;
    private $id_forma_inclusao_capital_de_giro = 7;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proposta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contrato' => 1100377486,
            'estado_civil' => 'A',
            'renda' => 2000.00,
            'situacao_empregaticia' => '001',
            'descricao_empresa' => $this->faker->company(),
            'valor_solicitado' => 2000.00,
            'nome_beneficiario' => $this->faker->name,
            'cpf_beneficiario' => $this->faker->unique()->cpf(false),
            'forma_liberacao' => '5',
            'valor_liberacao' => 1325.13,
            'banco_liberacao' => '001',
            'agencia_liberacao' => 1234,
            'digito_agencia_liberacao' => 1,
            'conta_liberacao' => 12345678,
            'digito_conta_liberacao' => 1,
            'tipo_conta' => '1',
            'tipo_documento_identidade' => '01',
            'uf_documento_identidade' => $this->faker->stateAbbr,
            'numero_documento_identidade' => $this->faker->rg(false),
            'politicamente_exposto' => false,
            'cargo_politico' => '',
            'parente_politicamente_exposto' => false,
            'cargo_parente_politico' => '',
            'plano' => '0041',
            'data_solicitacao_proposta' => date('Y-m-d H:i:s'),
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
            'data_geracao_proposta' => $this->faker->date('Y-m-d H:i:s'),
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
        ];
    }
}
