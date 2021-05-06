@extends('assinatura-contrato.index')
@section('content')

@if(isset($contrato))
<table align="center">
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tr align="center">
        <td valign="center"><h1>CÉDULA DE CRÉDITO BANCÁRIO</h1></td>
    </tr>
</table>

<table class="withBorder" cellpadding="4"  nobr="true">
    <thead>
        <tr>
            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th> </tr>
    </thead>
    <tbody>
        <tr>
            <td align="right" valign="center" colspan="12"><h2>CCB Nº. <?php if (isset($contrato)) echo $contrato ?></h2></td>
        </tr>
        <tr>
            <td align="left" valign="center" colspan="12"><h2>CREDOR: Ágil</h2></td>
        </tr>
        <tr>
            <td align="left" valign="center" colspan="12"><h3><b>COBUCCIO SOCIEDADE DE CRÉDITO DIRETO S.A.</b>,
                    doravante denominada simplesmente <b>CREDOR</b>, instituição financeira devidamente
                    constituída e existente de acordo com as leis do Brasil, com sede na Cidade
                    de Monte Belo, Estado de Minas Gerais, na Avenida Jorge Vieira, 257 - Centro,
                    CEP 37.115-000 e inscrita no CNPJ sob o nº 36.947.229/0001-85.</h3>
            </td>
        </tr>

        <tr align="left">
            <td class="border grey" colspan="12" valign="center"><h2>QUADRO I – QUALIFICAÇÃO DO EMITENTE:</h2></td>
        </tr>

        <tr>
            <td colspan="8" align="left" valign="top"><h3>Razão Social:</h3>
                <h4><?= $cliente_assinatura['   '] ?? '-------' ?></h4>
            </td>
            <td colspan="8" align="left" valign="top"><h3>CNPJ:</h3>
                <h4><?= $cliente_assinatura['cnpj'] ?? '-------' ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" align="left" valign="top"><h3>I. E. n°:</h3>
                <h4><?= $cliente_assinatura['inscricao_estadual'] ?? '-------' ?></h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>Tipo Empresa:</h3><h4><?= $cliente_assinatura['tipo_empresa'] ?? '-------' ?></h4>
            </td>
            <td colspan="8" align="left" valign="top"><h3>E-mail:</h3>
                <h4><?= $cliente_assinatura['email'] ?? '-------' ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>Endereço Res.:</h3>
                <h4><?= $cliente_assinatura['logradouro'] ?? '-------' ?></h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>Bairro:</h3>
                <h4><?= $cliente_assinatura['bairro'] ?? '-------' ?></h4>
            </td>
            <td  colspan="2" align="left" valign="top"><h3>UF:</h3>
                <h4><?= $cliente_assinatura['uf'] ?? '-------' ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>Cidade:</h3>
                <h4><?= $cliente_assinatura['cidade'] ?? '-------' ?></h4>
            </td>
            <td  colspan="3" align="left" valign="top"><h3>CEP:</h3>
                <h4><?= $cliente_assinatura['cep'] ?? '-------' ?></h4>
            </td>
            <td  colspan="3" align="left" valign="top"><h3>Telefone:</h3>
                <h4><?= $cliente_assinatura['telefone'] ?? '-------' ?></h4>
            </td>
        </tr>

        <tr>
            <td colspan="6" align="left" valign="top"><h3>Representante Legal:</h3>
                <h4><?= $representante['nome'] ?></h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>CPF:</h3>
                <h4><?= $representante['cpf'] ?></h4>
            </td>
            <td colspan="2" align="left" valign="top"><h3>Sexo:</h3>
                <h4><?= $representante['sexo'] ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>E-mail:</h3>
                <h4><?= $representante['email'] ?></h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>RG n.º:</h3>
                <h4><?= $representante['numero_documento_identidade'] ?></h4>
            </td>
            <td colspan="2" align="left" valign="top"><h3>Estado Civil:</h3>
                <h4><?= $representante['estado_civil'] ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>Endereço Res.:</h3>
                <h4><?= $representante['logradouro'] ?></h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>Bairro:</h3>
                <h4><?= $representante['bairro'] ?></h4>
            </td>
            <td colspan="2" align="left" valign="top"><h3>UF:</h3>
                <h4><?= $representante['uf'] ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>Cidade:</h3>
                <h4><?= $representante['cidade'] ?></h4>
            </td>
            <td colspan="3" align="left" valign="top"><h3>CEP:</h3>
                <h4><?= $representante['cep'] ?></h4>
            </td>
            <td colspan="3" align="left" valign="top"><h3>Celular:</h3>
                <h4><?= $representante['celular'] ?></h4>
            </td>
        </tr>

        <tr align="left">
            <td class="border grey" valign="center" colspan="12"><h2>QUADRO II ESPECIFICAÇÕES DO CRÉDITO:</h2>
                <h4>(<?= $espec_credito ?? 0 == 1 ? 'X' : ' ' ?>) Capital de Giro Parcelado ( ) Capital de Giro Fixo (<?= $espec_credito ?? 0 == 2 ? 'X' : ' ' ?>) Refinanciamento Contrato Nº <?= $ref_contrato_n ?? '' != '' ? $ref_contrato_n : '______' ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="4" align="left" valign="top"><h3>1. Valor Empréstimo:</h3>
                <h4>R$ <?= number_format($valor_liquido_credito, 2, ',', '.') ?></h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>2. Valor IOF:</h3>
                <h4>R$ <?= number_format($valor_iof, 2, ',', '.') ?></h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>3- Tarifa de Cadastro:</h3>
                <h4>R$ <?= number_format($tac, 2, ',', '.') ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>4. (1+2+3) Valor Financiado:</h3>
                <h4>R$ <?= number_format($valor_financiado_total, 2, ',', '.') ?></h4>
            </td>
            <td colspan="6" align="left" valign="top"><h3>5. Saldo Devedor Refinanciamento:</h3>
                <h4><?= 0 ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>6. (4-2-3-5-14) Valor Líquido do Crédito:</h3>
                <h4>R$ <?= number_format($valor_liquido_credito, 2, ',', '.') ?></h4>
            </td>
            <td colspan="3" align="left" valign="top"><h3>7. Valor da Parcela:</h3>
                <h4>R$ <?= number_format($valor_parcela, 2, ',', '.') ?></h4>
            </td>
            <td colspan="3" align="left" valign="top"><h3>8. Quantidade de Parcelas:</h3>
                <h4><?= $quantidade_parcela ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>9. Vencimento da 1ª Parcela:</h3>
                <h4><?= date('d/m/Y', strtotime($parcelas[0]['vencimento'])) ?? '-' ?></h4>
            </td>
            <td colspan="6" align="left" valign="top"><h3>10. Taxa de Juros:</h3>
                <h4><?= round($taxa_juros_mes, 2) ?>% ao mês <?= round($taxa_juros_ano, 2) ?>% ao ano</h4>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="left" valign="top"><h3>11. Vencimento da Última Parcela:</h3>
                <h4><?= date('d/m/Y', strtotime(end($parcelas)['vencimento'])) ?? '-' ?></h4>
            </td>
            <td colspan="6" align="left" valign="top"><h3>12. Custo Efetivo Total – CET:</h3>
                <h4><?= round($cet_mes, 2) ?>% ao mês <?= round($cet_ano, 2) ?>% ao ano</h4>
            </td>
        </tr>
        <tr>
            <td colspan="8" align="left" valign="top"><h3>13. Forma de Pagamento:</h3>
                <h4>(<?= $form_pg ?? 0 == 1 ? 'X' : ' ' ?>)Débito em Conta (<?= $form_pg ?? 0 == 2 ? 'X' : ' ' ?>)Boleto Bancário (<?= $form_pg ?? 0 == 3 ? 'X' : ' ' ?>)Cheque</h4>
            </td>
            <td colspan="4" align="left" valign="top"><h3>14. Valor do Seguro:</h3>
                <h4>R$ <?= number_format($valor_seguro, 2, ',', '.') ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="12" align="left" valign="top"><h3>Obs:</h3>
                <h4>-</h4>
            </td>
        </tr>
        <tr>
            <td colspan="8" align="left" class="border grey" valign="center"><h2>QUADRO III – DADOS DA CONTA BANCÁRIA PARA DEPÓSITO DO EMPRÉSTIMO:</h2>
                <h4>(<?= $tipo_conta == 2 ? 'X' : ' ' ?>) Poupança (<?= $tipo_conta == 1 ? 'X' : ' ' ?>) C/C</h4>
            </td>
            <td colspan="4" align="left" class="border grey" valign="center"><h2>QUADRO IV – ENCARGOS MORATÓRIOS:</h2></td>
        </tr>
        <tr>
            <td colspan="8" align="left" valign="top"><h3>15. Banco: <?= $banco_liberacao ?>  Agência: <?= $agencia_liberacao ?> - <?= $digito_agencia_liberacao ?>  Conta: <?= $conta_liberacao ?> - <?= $digito_conta_liberacao ?>&emsp;<?= $valor_liquido_credito ?? 0 ?></h3>
                <h3>OU QUALQUER OUTRA DE TITULARIDADE DO EMITENTE</h3>
            </td>
            <td colspan="4" align="left" valign="top"><h3>16.Multa: 2% <br>17.Juros Moratórios: 1%
                    <?/*php$juros_remuneratorios*/ ?>
                </h3>
            </td>
        </tr>
    </tbody>
</table>

<br>

<table class="withBorder" style="width: 100%;page-break-inside:avoid;" cellpadding="4" nobr="true">
    <thead>
        <tr>
            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
    </thead>
    <tbody>
        <tr align="left">
            <td class="border grey" valign="center" colspan="12"><h2>QUALIFICAÇÃO DOS AVALISTAS:</h2></td>
        </tr>
        <?php
        $table = '';
        foreach ($socios as $socio) {
            $table = '' .
                '<tr>
                <td colspan="6" align="left" valign="top"><h3>Nome:</h3><h4>' . $socio['nome'] . '</h4></td>
                <td colspan="4" align="left" valign="top"><h3>CPF:</h3><h4>' . $socio['cpf'] . '</h4></td>
                <td colspan="2" align="left" valign="top"><h3>Sexo:</h3><h4>' . $socio['sexo'] . '</h4></td>
            </tr>
            <tr>
                <td colspan="6" align="left" valign="top"><h3>E-mail:</h3><h4>' . $socio['email'] . '</h4></td>
                <td colspan="4" align="left" valign="top"><h3>RG n.º:</h3><h4>' . $socio['numero_documento_identidade'] . '</h4></td>
                <td colspan="2" align="left" valign="top"><h3>Estado Civil:</h3><h4>' . $socio['estado_civil'] . '</h4></td>
            </tr>
            <tr>
                <td colspan="6" align="left" valign="top"><h3>Endereço Res.:</h3><h4>' . $socio['logradouro'] . '</h4></td>
                <td colspan="4" align="left" valign="top"><h3>Bairro:</h3><h4>' . $socio['bairro'] . '</h4></td>
                <td colspan="2" align="left" valign="top"><h3>UF:</h3><h4>' . $socio['uf'] . '</h4></td>
            </tr>
            <tr>
                <td colspan="6" align="left" valign="top"><h3>Cidade:</h3><h4>' . $socio['cidade'] . '</h4></td>
                <td colspan="3" align="left" valign="top"><h3>CEP:</h3><h4>' . $socio['cep'] . '</h4></td>
                <td colspan="3" align="left" valign="top"><h3>Celular:</h3><h4>' . $socio['celular'] . '</h4></td>
            </tr>';
            echo $table;
        }
        ?>
    </tbody>
</table>
@endif

@endsection