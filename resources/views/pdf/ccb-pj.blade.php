<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <style>
        h1 {
            font-size: 16px;
            font-weight: bold;
        }

        h2 {
            font-size: 10px;
            font-weight: bold;
            margin: 0;
            margin-bottom: 2px;
        }

        h3 {
            font-size: 9px;
            font-weight: bold;
            margin: 0;
            margin-bottom: 2px;
        }

        h4 {
            text-transform: uppercase;
            font-size: 9px;
            margin: 0;
            margin-bottom: 2px;
        }

        h5 {
            font-size: 9px;
            margin: 0;
            margin-bottom: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding-left: 5px;
            padding-bottom: 5px;
            padding-top: 2px;
        }

        .border {
            border: 1px solid black;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .pagenum:before {
            content: counter(page);
        }

        .grey {
            background-color: #D9D9D9;
        }

        .p {
            padding-left: 20px;
        }
    </style>

</head>

<body>

    <table align="center">
        <tr align="center">
            <td valign="center">
                <h1>CÉDULA DE CRÉDITO BANCÁRIO</h1>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr align="right">
            <td class="border" valign="center">
                <h2>CCB Nº.
                    <?= $contrato ?? '-------' ?>
                </h2>
            </td>
        </tr>
        <tr align="left">
            <td class="border" valign="center">
                <h2>CREDOR:<br><?= $nome_beneficiario ?? '-------' ?></h2>
            </td>
        </tr>
        <tr align="left">
            <td class="border" valign="center">
                <h3><b>COBUCCIO SOCIEDADE DE CRÉDITO DIRETO S.A.</b>,
                    doravante denominada simplesmente <b>CREDOR</b>, instituição financeira devidamente
                    constituída e existente de acordo com as leis do Brasil, com sede na Cidade
                    de Monte Belo, Estado de Minas Gerais, na Avenida Jorge Vieira, 257 - Centro,
                    CEP 37.115-000 e inscrita no CNPJ sob o nº 36.947.229/0001-85.</h3>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr align="left">
            <td class="border grey" valign="center">
                <h2>QUADRO I – QUALIFICAÇÃO DO EMITENTE:</h2>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr>
            <td colspan="3" align="left" class="border" valign="top">
                <h3>Razão Social:</h3>
                <h4><?= $cliente_assinatura['razao_social'] ?? '-------' ?></h4>
            </td>
            <td colspan="1" align="left" class="border" valign="top" style="width: 35%!important;">
                <h3>CNPJ:</h3>
                <h4><?= $cliente_assinatura['cnpj'] ?? '-------' ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="1" align="left" class="border" valign="top">
                <h3>I. E. n°:</h3>
                <h4><?= $cliente_assinatura['inscricao_estadual'] ?? '-------' ?></h4>
            </td>
            <td colspan="1" align="left" class="border" valign="top" style="width: 18%!important;">
                <h3>Tipo Empresa:</h3>
                <h4><?= $cliente_assinatura['tipo_empresa'] ?? '-------' ?></h4>
            </td>
            <td colspan="1" align="left" class="border" valign="top" style="width: 18%!important;">
                <h3></h3>
                <h4></h4>
            </td>
            <td colspan="2" align="left" class="border" valign="top" style="width: 35%!important;">
                <h3>E-mail:</h3>
                <h4><?= $cliente_assinatura['email'] ?? '-------' ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="left" class="border" valign="top">
                <h3>Endereço Res.:</h3>
                <h4><?= $cliente_assinatura['logradouro'] ?? '-------' ?></h4>
            </td>
            <td colspan="1" align="left" class="border" valign="top" style="width: 35%!important;">
                <h3>Bairro:</h3>
                <h4><?= $cliente_assinatura['bairro'] ?? '-------' ?></h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>Cidade:</h3>
                <h4><?= $cliente_assinatura['cidade'] ?? '-------' ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 18%!important;">
                <h3>UF:</h3>
                <h4><?= $cliente_assinatura['uf'] ?? '-------' ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 18%!important;">
                <h3>CEP:</h3>
                <h4><?= $cliente_assinatura['cep'] ?? '-------' ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 35%!important;">
                <h3>Telefone:</h3>
                <h4><?= $cliente_assinatura['telefone'] ?? '-------' ?></h4>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr>
            <td colspan="3" align="left" class="border" valign="top">
                <h3>Representante Legal:</h3>
                <h4><?= $representante['nome'] ?></h4>
            </td>
            <td colspan="1" align="left" class="border" style="width: 35%!important;" valign="top">
                <h3>CPF:</h3>
                <h4><?= $representante['cpf'] ?></h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>RG n.º:</h3>
                <h4><?= $representante['numero_documento_identidade'] ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 18%!important;">
                <h3>Estado Civil:</h3>
                <h4><?= $representante['estado_civil'] ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 18%!important;">
                <h3>Sexo:</h3>
                <h4><?= $representante['sexo'] ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 35%!important;">
                <h3>E-mail:</h3>
                <h4><?= $representante['email'] ?></h4>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="left" class="border" valign="top">
                <h3>Endereço Res.:</h3>
                <h4><?= $representante['logradouro'] ?></h4>
            </td>
            <td colspan="1" align="left" class="border" valign="top" style="width: 35%!important;">
                <h3>Bairro:</h3>
                <h4><?= $representante['bairro'] ?></h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>Cidade:</h3>
                <h4><?= $representante['cidade'] ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 18%!important;">
                <h3>UF:</h3>
                <h4><?= $representante['uf'] ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 18%!important;">
                <h3>CEP:</h3>
                <h4><?= $representante['cep'] ?></h4>
            </td>
            <td align="left" class="border" valign="top" style="width: 35%!important;">
                <h3>Celular:</h3>
                <h4><?= $representante['celular'] ?></h4>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr align="left">
            <td class="border grey" valign="center">
                <h2>QUALIFICAÇÃO DOS AVALISTAS:</h2>
            </td>
        </tr>
    </table>

    <?php
    $table = '';
    foreach ($socios as $socio) {
        $table = '' .
            '<table align="center">
            <tr>
                <td colspan="3" align="left" class="border" valign="top"><h3>Nome:</h3><h4>' . $socio['nome'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 35%!important;"><h3>CPF:</h3><h4>' . $socio['cpf'] . '</h4></td>
            </tr>
            <tr>
                <td colspan="1" align="left" class="border" valign="top"><h3>RG n.º:</h3><h4>' . $socio['numero_documento_identidade'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 18%!important;"><h3>Estado Civil:</h3><h4>' . $socio['estado_civil'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 18%!important;"><h3>Sexo:</h3><h4>' . $socio['sexo'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 35%!important;"><h3>E-mail:</h3><h4>' . $socio['email'] . '</h4></td>
            </tr>
            <tr>
                <td colspan="3" align="left" class="border" valign="top"><h3>Endereço Res.:</h3><h4>' . $socio['logradouro'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 35%!important;"><h3>Bairro:</h3><h4>' . $socio['bairro'] . '</h4></td>
            </tr>
            <tr>
                <td colspan="1" align="left" class="border" valign="top"><h3>Cidade:</h3><h4>' . $socio['cidade'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 18%!important;"><h3>UF:</h3><h4>' . $socio['uf'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 18%!important;"><h3>CEP:</h3><h4>' . $socio['cep'] . '</h4></td>
                <td colspan="1" align="left" class="border" valign="top" style="width: 35%!important;"><h3>Celular:</h3><h4>' . $socio['celular'] . '</h4></td>
            </tr>
        </table>';
        echo $table;
    }
    ?>

    <table align="center">
        <tr align="left">
            <td class="border grey" valign="center">
                <h2>QUADRO II ESPECIFICAÇÕES DO CRÉDITO:</h2>
                <h4>(<?= $espec_credito ?? 0 == 1 ? 'X' : ' ' ?>) Capital de Giro Parcelado &emsp;( ) Capital de Giro Fixo &emsp;(<?= $espec_credito ?? 0 == 2 ? 'X' : ' ' ?>) Refinanciamento Contrato Nº <?= $ref_contrato_n ?? '' != '' ? $ref_contrato_n : '______' ?></h4>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr>
            <td align="left" class="border" valign="top">
                <h3>1. Valor Empréstimo:</h3>
                <h4><?= $valor_liquido_credito ?></h4>
            </td>
            <td align="left" class="border" valign="top">
                <h3>2. Valor IOF:</h3>
                <h4><?= $valor_iof ?></h4>
            </td>
            <td align="left" class="border" valign="top">
                <h3>3- Tarifa de Cadastro:</h3>
                <h4><?= $tac ?></h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>4. (1+2+3) Valor Financiado:</h3>
                <h4><?= $valor_financiado_total ?></h4>
            </td>
            <td colspan="2" align="left" class="border" valign="top">
                <h3>5. Saldo Devedor Refinanciamento:</h3>
                <h4><?= 0 ?></h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>6. (4-2-3-5-14) Valor Líquido do Crédito:</h3>
                <h4><?= $valor_liquido_credito ?></h4>
            </td>
            <td align="left" class="border" valign="top">
                <h3>7. Valor da Parcela:</h3>
                <h4><?= $valor_parcela ?></h4>
            </td>
            <td align="left" class="border" valign="top">
                <h3>8. Quantidade de Parcelas:</h3>
                <h4><?= $quantidade_parcela ?></h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>9. Vencimento da 1ª Parcela:</h3>
                <h4><?= $parcelas[0]['vencimento'] ?></h4>
            </td>
            <td colspan="2" align="left" class="border" valign="top">
                <h3>10. Taxa de Juros:</h3>
                <h4><?= $taxa_juros_mes ?>% ao mês <?= $taxa_juros_ano ?>% ao ano</h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>11. Vencimento da Última Parcela:</h3>
                <h4><?= end($parcelas)['vencimento'] ?></h4>
            </td>
            <td colspan="2" align="left" class="border" valign="top">
                <h3>12. Custo Efetivo Total – CET:</h3>
                <h4><?= $cet_mes ?>% ao mês <?= $cet_ano ?>% ao ano</h4>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="left" class="border" valign="top">
                <h3>13. Forma de Pagamento:</h3>
                <h4>(<?= $form_pg ?? 0 == 1 ? 'X' : ' ' ?>) Débito em Conta &emsp;(<?= $form_pg ?? 0 == 2 ? 'X' : ' ' ?>) Boleto Bancário &emsp;(<?= $form_pg ?? 0 == 3 ? 'X' : ' ' ?>) Cheque </h4>
            </td>
            <td align="left" class="border" valign="top">
                <h3>14. Valor do Seguro:</h3>
                <h4><?= $valor_seguro ?></h4>
            </td>
        </tr>
        <tr>
            <td align="left" class="border" valign="top">
                <h3>14. Valor do Seguro:</h3>
                <h4><?= $valor_seguro ?></h4>&emsp;
            </td>
            <td colspan="2" align="left" class="border" valign="top">
                <h3>15. Garantia:</h3>
                <h4>&emsp;</h4>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="left" class="border" valign="top">
                <h3>Obs:</h3>
                <h4>-</h4>
            </td>
        </tr>

    </table>

    <table align="center">
        <tr align="left">
            <td class="border grey" valign="center" style="width: 68%">
                <h2>QUADRO III – DADOS DA CONTA BANCÁRIA PARA DEPÓSITO DO EMPRÉSTIMO:</h2>
                <h4>(<?= $tipo_conta == 2 ? 'X' : ' ' ?>) Poupança &emsp;(<?= $tipo_conta == 1 ? 'X' : ' ' ?>) C/C</h4>
            </td>
            <td class="border grey" valign="center">
                <h2>QUADRO IV – ENCARGOS MORATÓRIOS:</h2>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr>
            <td align="left" class="border" valign="top" style="width: 68%">
                <h3>15. Banco: <?= $banco_liberacao ?> &emsp; Agência: <?= $agencia_liberacao ?> - <?= $digito_agencia_liberacao ?> &emsp; Conta: <?= $conta_liberacao ?> - <?= $digito_conta_liberacao ?>&emsp;<?= $valor_liquido_credito ?? 0 ?></h3>
                <h3>OU QUALQUER OUTRA DE TITULARIDADE DO EMITENTE</h3>
            </td>
            <td align="left" class="border" valign="top">
                <h3>16.Multa: 2% <br>17.Juros Moratórios: 1%
                    <?/*php$juros_remuneratorios*/?>
                </h3>
            </td>
        </tr>
    </table>


</body>


</html>
