<?php
setlocale(LC_MONETARY, 'it_IT');
?>

<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <style>

        h1 {
            font-size: 12px;
            font-weight: bold;
        }

        h2 {
            font-size: 8px;
            font-weight: bold;
        }

        h3 {
            font-size: 7px;
            font-weight: bold;
        }

        h4 {
            text-transform: uppercase;
            font-size: 7px;
        }

        h5 {
            font-size: 6px;
        }

        table {
            width: 100%;
        }

        table td {
            vertical-align: top;
            line-height: 14px;
        }

        .withBorder td {
            border: 0.3rem solid black;
        }

        table tr {
            align-items: center;
            justify-content: center;
            vertical-align: top;
            line-height: 15px
        }

        tr {
            width: 100%;
        }

        .border {
            border: 1px solid black;
        }

        .pagenum:before {
            content: counter(page);
        }

        .grey {
            background-color: #D9D9D9;
        }

        .clausulas{
            font-size: 10px;
        }

        .p {
            margin-left: 20px;
        }
    </style>

</head>

<body>

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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
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
                    <h4><?= $cliente_assinatura['razao_social'] ?? '-------' ?></h4>
                </td>
                <td colspan="8" align="left" valign="top"><h3>CNPJ:</h3>
                    <h4><?= $cliente_assinatura['cnpj'] ?? '-------' ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="left" valign="top"><h3>I. E. n°:</h3>
                    <h4><?= $cliente_assinatura['inscricao_estadual'] ?? '-------' ?></h4>
                </td>
                <td colspan="4" align="left" valign="top"><h3>Tipo Empresa:</h3><h4><?= $cliente_assinatura['tipo_empresa']['descricao'] ?? '-------' ?></h4>
                </td>
                <td colspan="8" align="left" valign="top"><h3>E-mail:</h3>
                    <h4><?= $cliente_assinatura['email'] ?? '-------' ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="left" valign="top"><h3>Endereço:</h3>
                    <h4><?= ($cliente_assinatura['tipo_logradouro']['descricao'] ?? '-------') . ' ' . ($cliente_assinatura['logradouro'] ?? '-------') . ', ' . ($cliente_assinatura['numero'] ?? '-') ?></h4>
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
                    <h4><?= $representante['tipo_logradouro']['descricao'] . ' ' . $representante['logradouro'] . ', ' . $representante['numero'] ?></h4>
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
                    <h4>(X) Capital de Giro Parcelado ( ) Capital de Giro Fixo (<?= $espec_credito ?? 0 == 2 ? 'X' : ' ' ?>) Refinanciamento Contrato Nº <?= $ref_contrato_n ?? '' != '' ? $ref_contrato_n : '______' ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="left" valign="top"><h3>1. Valor Empréstimo:</h3>
                    <h4>R$ <?= number_format($valor_liquido_credito, 2, ',', '.') ?></h4>
                </td>
                <td colspan="2" align="left" valign="top"><h3>2. Valor IOF:</h3>
                    <h4>R$ <?= number_format($valor_iof, 2, ',', '.') ?></h4>
                </td>
                <td colspan="2" align="left" valign="top"><h3>2.1. Em % empréstimo:</h3>
                    <h4><?= number_format((($valor_iof * 100)/$valor_liquido_credito), 2, ',', '') ?></h4>
                </td>
                <td colspan="2" align="left" valign="top"><h3>3. Tarifa de Cadastro:</h3>
                    <h4>R$ <?= number_format($tac, 2, ',', '.') ?></h4>
                </td>
                <td colspan="2" align="left" valign="top"><h3>3.1. Em % empréstimo:</h3>
                    <h4><?= number_format((($tac * 100)/$valor_liquido_credito), 2, ',', '') ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="left" valign="top"><h3>4. (1+2+3) Valor Financiado:</h3>
                    <h4>R$ <?= number_format($valor_financiado_total, 2, ',', '.') ?></h4>
                </td>
                <td colspan="6" align="left" valign="top"><h3>5. Saldo Devedor Refinanciamento:</h3>
                    <h4>R$ <?= number_format(0, 2, ',', '.') ?></h4>
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
                <td colspan="6" align="left" valign="top"><h3>13. Forma de Pagamento:</h3>
                    <h4>( )Débito em Conta (X)Boleto Bancário ( )Cheque</h4>
                </td>
                <td colspan="6" align="left" valign="top"><h3>12.1. Valor Total de Juros: R$ <?= number_format($valor_total_juros, 2, ',', '.') ?></h3>
                    <h3>12.2. Valor Total Devido: R$ <?= number_format($valor_total_a_pagar, 2, ',', '.') ?> </h3>
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
                <td colspan="8" align="left" valign="top"><h3>14. Banco: <?= $banco_liberacao ?>  Agência: <?= $agencia_liberacao ?> - <?= $digito_agencia_liberacao ?>  Conta: <?= $conta_liberacao ?> - <?= $digito_conta_liberacao ?></h3>
                    <h3>OU QUALQUER OUTRA DE TITULARIDADE DO EMITENTE</h3>
                </td>
                <td colspan="4" align="left" valign="top"><h3>15. Multa: 2% <br>16. Juros Moratórios: 1%
                        <?/*php$juros_remuneratorios*/ ?>
                    </h3>
                </td>
            </tr>
            <tr>
                <td colspan="12" align="left" class="border grey" valign="center"><h2>QUADRO V – PESSOAS POLITICAMENTE EXPOSTAS:
                    </h2>
                </td>
            </tr>
            <tr>
                <td colspan="12" align="left" valign="top"><h3>17. O EMITENTE, algum de seus familiares (pai, mãe, filho(a), cônjuge, companheiro(a), enteado(a)), ou outra pessoa de seu relacionamento próximo, desempenha(ou) nos últimos 05 (cinco) anos, no Brasil ou em países, territórios e dependências estrangeiros, cargos, empregos ou funções públicas em empresas ou órgãos de serviços públicos (executivo, legislativo ou judiciário), nos âmbitos federal, estadual ou municipal, nos moldes da Resolução COAF nº 16/07, art. 1º, § 1º, no artigo 3º da Deliberação COERME nº2/06 e na Circular BACEN nº 3.461/09 e 3.978/2020, bem como as normas aplicáveis da CVM, Instrução CVM nº 463/08.
                    <br/>
                    Sou Pessoa Politicamente Exposta? (<?= $representante['politicamente_exposto'] ? 'X' : ' ' ?>)Sim (<?= $representante['politicamente_exposto'] ? ' ' : 'X' ?>)Não Cargo/Função: <?= ($representante['cargo_politico'] != NULL) ? $representante['cargo_politico'] : ''; ?>
                    <br>
                    Possuo Parentes Politicamente Expostos? (<?= $representante['parente_politicamente_exposto'] ? 'X' : ' ' ?>)Sim (<?= $representante['parente_politicamente_exposto'] ? ' ' : 'X' ?>)Não Cargo/Função: <?= ($representante['cargo_parente_politico'] != NULL) ? $representante['cargo_parente_politico'] : ''; ?>
                    </h3>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="withBorder" style="width: 100%;page-break-inside:avoid;" cellpadding="4" nobr="true">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="12" align="left" class="border grey" valign="center"><h2>QUADRO VI – AUTORIZAÇÃO:
                    </h2>
                </td>
            </tr>
            <tr>
                <td colspan="12" align="left" valign="top"><h3>18. O EMITENTE autoriza o CREDOR, respeitada a legislação em vigor, (i) a compartilhar com as empresas parceiras que compõem seu grupo econômico, seus dados pessoais aqui constantes, (ii) a utilizar-se destes dados para oferta por qualquer meio, inclusive telefônico, e-mail, SMS e correspondências promocionais, considerando que tal autorização poderá ser cancelada a qualquer momento, e (iii) enviar um cartão de crédito pré-aprovado em conjunto com abertura de conta digital (X)Sim ( )Não.
                    </h3>
                </td>
            </tr>
            <tr align="left">
                <td class="border grey" valign="center" colspan="12"><h2>QUADRO VII QUALIFICAÇÃO DOS DEMAIS SÓCIOS:</h2></td>
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
                    <td colspan="6" align="left" valign="top"><h3>Endereço Res.:</h3><h4>' . $socio['tipo_logradouro']['descricao'] . ' ' . $socio['logradouro'] . ', ' . $socio['numero'] . '</h4></td>
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


    <table align="center">
        <thead>
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr align="center">
                <td valign="center">
                    <h1>CONDIÇÕES GERAIS DA CÉDULA DE CRÉDITO BANCÁRIO </h1>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
            <!-- <tr> -->
                <!-- <td style="text-align: justify; font-size: 12px"> -->
    <div class="clausulas">
        <span class="p"></span>1. Na qualidade de <b>EMITENTE</b> da presente Cédula de Crédito Bancário (CCB), reconheço como título executivo extrajudicial, nos moldes do art. 28 da Lei Fed. Nº 10.931, de 02/08/2004 e suas alterações posteriores, representativo do crédito concedido pelo <b>CREDOR</b>, indicado no item 1, do Quadro II acima, PROMETO pagar ao <b>CREDOR</b>, ou a sua ordem, o valor ora contratado, como líquido, certo e exigível, na forma e prazos previstos nesta CCB, apurado nos termos presentes e de acordo com (i) as condições incluídas no “Quadro Resumo” acima; (ii) Especificações Gerais do Crédito (Quadro II) e a legislação vigente.
        <br/><br/>

        <span class="p"></span>1.1. Esta CCB será emitida em formato eletrônico e deverá ser assinada eletronicamente, sendo realizada digitalmente por meio de certificado digital do ICP Brasil, nos termos da Medida Provisória n.º 2.200-2, de 24 de agosto de 2001, ou por qualquer outro meio eletrônico, o qual confirme que o <b>EMITENTE</b> inequivocadamente exprimiu sua vontade, possuindo eficácia e legitimidade nos termos do artigo 219, caput, do Código Civil Brasileiro.
        <br/><br/>

        <span class="p"></span>2. O<b><b>CREDOR</b></b> concede, em favor do <b>EMITENTE</b>, o crédito acima descrito, acrescido de todos os custos, tarifas e tributos abaixo especificados, dos quais o <b>EMITENTE</b> declara que aceita todos os valores incidentes e recebeu do <b>CREDOR</b> todos os esclarecimentos acerca deles.
        <br/><br/>

        <span class="p"></span>3. O <b>EMITENTE</b> declara ter ciência que as parcelas deverão ser pagas na forma definida no item 13 e na data constante no item 9, até a data de vencimento da última parcela conforme item 11, do Quadro II, consignando que as cobranças serão efetuadas em parcelas sucessivas, na ordem cronológica de vencimento, sendo que o recebimento da parcela pelo <b>CREDOR</b> (ou o cessionário/endossatário desta Cédula) e/ou eventual agente de cobrança contratado não significará a quitação da(s) parcela(s) anterior(es).
        <br/><br/>

        <span class="p"></span>4. Caso o emitente possua representante legal, o mesmo terá de proceder seguindo a legislação em vigor, provando sua condição de mandatário do <b>EMITENTE</b>.
        <br/><br/>

        <span class="p"></span>5. O <b>EMITENTE</b> declara que, previamente à emissão da presente CCB, ter tomado ciência dos fluxos que compõem o Custo Efetivo Total (CET), e que a taxa percentual anual representa a condição vigente na data do cálculo. Para o cálculo do CET são considerados o valor do crédito concedido, o número de parcelas e a data de pagamento, a taxa de juros, os valores dos tributos incidentes sobre a operação, das tarifas e dos pagamentos a terceiros.
        <br/><br/>

        <span class="p"></span>6. O <b>EMITENTE</b> pagará ao <b>CREDOR</b> os valores recebidos em razão desta CCB (sendo, portanto, dívida certa, líquida e exigível), acrescidos de juros capitalizados à taxa descrita no Quadro Resumo e encargos, mensalmente, na praça da sua sede, ou a sua ordem, na forma de pagamento descrita no Quadro Resumo.
        <br/><br/>

        <span class="p"></span>6.1. Os documentos de cobrança serão enviados pelo <b>CREDOR</b> ao endereço informado no Quadro I. O não recebimento dos referidos documentos pelo <b>EMITENTE</b> não o eximirá da responsabilidade de pagar as parcelas nos exatos vencimentos.
        <br/><br/>

        <span class="p"></span>6.2. No caso de mudança de domicílio ou dos meios de comunicação eletrônica indicados, fica o <b>EMITENTE</b> obrigado a comunicar tal mudança ao <b>CREDOR</b>, por escrito, no prazo de 2 (dois) dias contados da mudança.
        <br/><br/>

        <span class="p"></span>6.3. Caso o vencimento de uma parcela caia em dia em que não haja expediente bancário, este será automaticamente prorrogado para o próximo dia útil.
        <br/><br/>

        <span class="p"></span>6.4. O <b>EMITENTE</b> renuncia à faculdade de realizar depósitos, identificados ou não, na conta corrente do <b>CREDOR</b>, sem que este tenha expressamente autorizado e entendendo que qualquer depósito feito em desacordo com o ora estipulado não constituirá quitação e poderá ser devolvido ao <b>EMITENTE</b> quando identificado. <b>Lembre-se: (i) ao emitir esta CCB o emitente concordará com todas as regras aqui estabelecidas; (ii) programe-se para pagar as parcelas nas respectivas datas de vencimento, caso contrário incidirão encargos por atraso e; (iii) saldar dívidas é sempre mais importante que gerar gastos extras, logo, não faça novas dívidas antes de quitar as atuais</b>.
        <br/><br/>

        <span class="p"></span>7. O Imposto sobre Operações de Crédito IOF, ou qualquer outro ônus fiscal que incida ou venha a incidir nessa operação, sempre na sua totalidade, será sempre de responsabilidade exclusiva do <b>EMITENTE</b>.
        <br/><br/>

        <span class="p"></span>8. O <b>EMITENTE</b> autoriza a <b>CREDOR</b>, em caráter irrevogável e irretratável, a informar e consultar informações referentes ao(s) mesmo(s) ao/no Sistema de Central de Risco - SCR, do Banco Central do Brasil, ainda que em momento anterior à celebração desta Cédula, aos/nos bancos de dados de proteção ao crédito e às/nas Câmaras de Liquidação/Intermediação, bem como levá-la a registro, incluindo seus eventuais anexos, em quaisquer registros públicos e instituições auxiliares do mercado financeiro.
        <br/><br/>

        <span class="p"></span>9. O <b>EMITENTE</b> tem ciência de que, a qualquer tempo, poderá efetuar a amortização ou liquidação antecipada desta CCB, sendo que o valor presente do pagamento antecipado será calculado com a utilização da taxa de juros pactuada no Quadro Resumo, conforme preceitua a legislação e a regulamentação vigentes, especialmente a Resolução n.º 3.516, do Conselho Monetário Nacional, de 06/12/2007 e posteriores que eventualmente a modifique.
        <br/><br/>

        <span class="p"></span>10. Para efeitos de liquidação antecipada o sistema de amortização respeitará o modelo de incidência do ônus fiscal, sendo que o IOF da operação será calculado e cobrado sobre o valor principal da operação, assim também entendido como a somatória dos valores das parcelas, conforme preceitua a legislação e a regulamentação vigentes, sendo que no momento da liquidação antecipada de parcelas, a mesma ocorrerá da última parcela a vencer para primeira, podendo ocorrer o pagamento parcial de uma parcela.
        <br/><br/>

        <span class="p"></span>11. Esta CCB terá o seu vencimento antecipado, independentemente de qualquer aviso, notificação ou interpelação prévia, judicial ou extrajudicial, englobando principal e acessórios, que se tornarão imediatamente exigíveis, a exclusivo critério do <b>CREDOR</b>, de acordo com o previsto em lei e nas seguintes hipóteses: (i) descumprimento pelo(a) <b>EMITENTE</b> de qualquer obrigação pactuada nesta CCB ou de qualquer outro contrato, Cédula de Crédito Bancário ou obrigação pactuada entre o <b>EMITENTE</b> e o <b>CREDOR</b>, especialmente inadimplência em relação a quaisquer parcelas vencidas; (ii) ocorrência de qualquer uma das hipóteses previstas no artigo 333 e 1.425, do Código Civil; (iii) se for apurada a falsidade de qualquer declaração, informação ou documento que houver sido, respectivamente, firmado, prestado ou entregue pelo(a) <b>EMITENTE</b>; (iv) se houver mudança no estado econômico-financeiro do(a) <b>EMITENTE</b> que, a critério do <b>CREDOR</b>, possa prejudicar a capacidade de cumprimento das obrigações ora assumidas; (v) Se o <b>EMITENTE</b> ceder ou transferir a terceiros os direitos e obrigações decorrentes desta CCB, sem o prévio e expresso consentimento do <b>CREDOR</b>.
        <br/><br/>

        <span class="p"></span>12. A mora do <b>EMITENTE</b> no pagamento de quaisquer das parcelas previstas nos termos desta CCB sujeitará o <b>EMITENTE</b>, independentemente de notificação ou interpelação, judicial ou extrajudicial, aos seguintes encargos: (i) multa moratória equivalente a 2% (dois por cento) sobre o valor em atraso, (ii) juros remuneratórios computados até a data do pagamento, na forma prevista no Quadro Resumo desta Cédula; (iii) juros moratórios equivalentes a 1% (um por cento) ao mês, calculados de forma pro rata e capitalizadas na periodicidade prevista no Quadro Resumo IV item 17, desde a data de vencimento da obrigação, até a data de seu pagamento, sem prejuízo dos impostos que incidam ou que venham a incidir.
        <br/><br/>

        <span class="p"></span>12.1. Serão devidas, também, todas as despesas de cobrança extrajudicial e as custas e honorários de advogados (i) na fase extrajudicial, na ordem de 10% (dez por cento); e (ii) judicial na ordem de 20% (vinte por cento).
        <br/><br/>

        <span class="p"></span>13. <b>O <b>EMITENTE</b> tem ciência, se for o caso, de que o atraso no pagamento de quaisquer das parcelas desta Cédula sujeitará à negativação do(s) respectivo(s) nome(s) e CPF(s)/CNPJ(s) nos Bancos de Dados de Proteção ao Crédito, observada a legislação aplicável</b>.
        <br/><br/>

        <span class="p"></span>14. O <b>EMITENTE</b> declara estar ciente de que a presente CCB consiste em título executivo extrajudicial e representativo de dívida em dinheiro, certa, líquida e exigível, seja pela soma indicada, seja pelo saldo devedor demonstrado em planilha de cálculo emitida pelo <b>CREDOR</b>, nos termos do artigo 28, caput, da Lei 10.931/2004, cuja apresentação pelo <b>CREDOR</b> será suficiente para a exigibilidade de seu crédito, reconhecendo que os extratos da conta corrente mencionada e as planilhas de cálculo apresentadas pelo Credor (ou o cessionário/endossatário desta Cédula) fazem parte desta Cédula e que os valores deles constantes são líquidos, certos e determinados.
        <br/><br/>

        <span class="p"></span>15. O <b>CREDOR</b> poderá endossar, ceder ou transferir, no todo ou em parte, os direitos e obrigações desta Cédula, a seu exclusivo critério, sem qualquer necessidade de comunicação prévia, bem como utilizar essa Cédula na captação de recursos financeiros, conforme estabelece as normas vigentes do Banco Central do Brasil. Em caso de endosso, cessão ou transferência desta CCB, eventual cessionário ou endossatário será responsável pelo atendimento ao <b>EMITENTE</b>.
        <br/><br/>

        <span class="p"></span>16. O <b>CREDOR</b> poderá emitir Certificados de Cédula de Crédito Bancário com lastro na presente CCB, podendo negociá-los livremente no mercado, tudo em conformidade com os artigos 43 e 44 da Lei nº 10.931, de 02 de agosto de 2004, e com as normas emanadas do Conselho Monetário Nacional e do Banco Central.
        <br/><br/>

        <span class="p"></span>17. Todas as alterações a esta CCB deverão ser efetivadas por escrito, via digital/eletrônica, através de aditamentos acordados mutuamente. A eventual tolerância ou omissão por parte do <b>CREDOR</b> no exercício de qualquer direito que lhe for conferido não importará em alteração ou novação, nem os impedirá de exercer, a qualquer momento, todos os direitos que lhe são assegurados nesta CCB ou pela lei.
        <br/><br/>

        <span class="p"></span>18. O <b>EMITENTE</b> declara serem verdadeiras todas as informações aqui prestadas e se compromete a informar, por escrito, no prazo máximo de 10 (dez) dias, sempre que houver qualquer alteração, remetendo, inclusive, os respectivos documentos comprobatórios de tais alterações.
        <br/><br/>

        <span class="p"></span>19. O <b>EMITENTE</b> autoriza ao <b>CREDOR</b> a verificar os dados constantes no cadastro e fornecer ao Banco Central do Brasil, ao Conselho de Controle de Atividades Financeiras, à Comissão de Valores Mobiliários, à Receita Federal a qualquer tempo, informações relativas a seus dados cadastrais, saldos e movimentações financeiras.
        <br/><br/>

        <span class="p"></span>20. Estando as partes, <b>EMITENTE</b> e <b>CREDOR</b>, imbuídas da boa-fé necessária a presente contratação, declaram: (i) que a presente contratação não apresentou vício de consentimento e espelha fielmente tudo o que foi ajustado e que tiveram conhecimento prévio do seu conteúdo, sendo que entenderam perfeitamente todas as disposições nela contidas; (ii) que são conhecedoras da regra contida no artigo 157 do Código Civil Brasileiro (lesão de direitos), não caracterizando a presente contratação qualquer fato ou obrigação que possa ser caracterizado como lesão; (iii) que não se encontram em estado de perigo; (iv) que as prestações assumidas são reconhecidas como manifestamente proporcionais e que elas estão dentro de suas condições econômico/financeiras; (v) que guardarão na execução deste instrumento os princípios da probidade e da boa-fé, presentes também na sua negociação e na sua celebração; (vi) que este instrumento é firmado com estrita observância dos princípios indicados nas alíneas precedentes, não importando em qualquer caso em abuso de direitos; e (vii) que estão cientes de todas as circunstâncias e regras que norteiam o presente negócio jurídico e detêm experiência nas atividades e obrigações que lhe competem por força deste instrumento.
        <br/><br/>

        <span class="p"></span>21. O <b>EMITENTE</b> autoriza ao <b>CREDOR</b> a gravar todas as comunicações telefônicas e, adicionalmente, reconhece e aceita que tais gravações sejam apresentadas como provas legítimas em ações e processos.
        <br/><br/>

        <span class="p"></span>22. Estou ciente de que a contratação do Seguro de Proteção Financeira é opcional e deve ocorrer única e exclusivamente de minha livre e espontânea vontade de obter proteção oferecida pelo referido seguro. Na hipótese de eu contratar o Seguro Proteção Financeira, a indenização por morte, invalidez permanente total por acidente, incapacidade física total temporária ou desemprego involuntário será destinada única e exclusivamente para a cobertura de eventual saldo devedor, total ou parcial, desta Cédula, dentro dos limites estabelecidos na apólice do seguro.
        <br/><br/>

        <span class="p"></span>23. Outorgo, neste ato, de forma irrevogável e irretratável, os poderes necessários ao <b>CREDOR</b> (ou o cessionário/endossatário desta Cédula) e/ou o eventual agente de cobrança contratado para o recebimento do seguro. O valor recebido por meio de seguro deverá ser única e exclusivamente utilizado para a liquidação do saldo devedor da presente Cédula e, caso o valor da referida indenização do seguro não seja suficiente para liquidar o saldo devedor, estou ciente que deverei pagar o saldo remanescente. Caso a indenização do seguro seja suficiente para quitar o saldo devedor, o valor que sobejar será devolvido para o segurado ou seus beneficiários, conforme as condições da apólice.
        <br/><br/>

        <span class="p"></span>24. As procurações, por instrumento particular e por instrumento público, somente serão consideradas como revogadas ou canceladas, para todos os efeitos, a partir do recebimento pelo <b>CREDOR</b> de comunicação escrita do(s) Cliente(s), ficando o <b>CREDOR</b>, na falta da mesma, isenta de qualquer responsabilidade.
        <br/><br/>

        <span class="p"></span>25. Constitui condição suspensiva para a eficácia desta CCB, nos termos do artigo 125 do Código Civil, a aprovação dos documentos e informações cadastrais do <b>EMITENTE</b> pelo <b>CREDOR</b>, no prazo de até 2 (dois) dias contados da emissão desta Cédula (Condição Suspensiva).
        <br/><br/>

        <span class="p"></span>26. Na hipótese de a condição suspensiva não ocorrer em até 2 (dois) dias após a emissão desta Cédula, a presente Cédula não será mais revestida de eficácia e se extinguirá de pleno direito, sem qualquer ônus ou penalidade para qualquer das partes.
        <br/><br/>

        <span class="p"></span>27. Declaro que estou ciente que o presente Contrato é firmado em caráter irrevogável e irretratável, vinculando, inclusive, meus herdeiros e sucessores a qualquer título, e que eventual repactuação ou cancelamento das autorizações de desconto em conta corrente, somente serão efetivadas com a expressa autorização do <b>CREDOR</b>.
        <br/><br/>

        <span class="p"></span>28. Os dados pessoais que serão tratados para a prestação dos serviços aqui previstos serão utilizados única e exclusivamente para cumprir com a finalidade a que se destinam e em respeito a toda a legislação aplicável sobre segurança da informação, privacidade e proteção de dados, inclusive, mas não se limitando somente a Lei Geral de Proteção de Dados (Lei Federal n. 13.709/2018).
        <br/><br/>

        <span class="p"></span>29. Nos termos da Lei Geral de Proteção de Dados (Lei nº 13.709/18), o <b>EMITENTE</b> autoriza e reconhece que o <b>CREDOR</b> realiza o tratamento de dados pessoais com finalidades específicas e de acordo com as bases legais previstas na respectiva Lei, tais como: para o devido cumprimento das obrigações legais e regulatórias, para o exercício regular de direitos e para a proteção do crédito, bem como, sempre que necessário, para a execução dos contratos firmados com seus clientes ou para atender aos interesses legítimos do <b>CREDOR</b>, de seus clientes ou de terceiros. Para qualquer outra finalidade, para a qual a lei não dispense a exigência do consentimento do titular, o tratamento estará condicionado à manifestação livre, informada e inequívoca do titular.
        <br/><br/>

        <span class="p"></span>30. Finalidades para Tratamento e Compartilhamento. O <b>EMITENTE</b> está ciente de que o <b>CREDOR</b>, na condição de controlador  de dados  nos  termos  da  legislação  aplicável,  poderá tratar,  coletar,  armazenar  e  compartilhar  com suas empresas parcerias, especificadas na cláusula seguinte,  sempre  com  a  estrita observância à Lei, seus dados pessoais e informações cadastrais,  financeiras e de operações ativas e passivas e serviços contratados para: (i) garantir maior segurança e prevenir fraudes; (ii) assegurar sua adequada identificação, qualificação e autenticação; (iii) prevenir atos relacionados à lavagem de dinheiro e outros atos ilícitos; (iv) realizar análises de risco de crédito; (v) aperfeiçoar o atendimento e os produtos e serviços prestados; (vi) fazer ofertas de produtos e serviços adequados e relevantes aos seus interesses e necessidades de acordo com o perfil do <b>EMITENTE</b>; e (vi) outras hipóteses  baseadas em finalidades legítimas como apoio e promoção de atividades do <b>CREDOR</b>, suas parceiras e das demais empresas que compõe ou venham a compor o Grupo Adriano Cobuccio ou para a prestação de serviços em benefício do <b>EMITENTE</b>, autorizado a:
        <br/><br/>

        <div style="padding-left: 30px;">
            (a). O <b>CREDOR</b> poderá compartilhar dados pessoais do <b>EMITENTE</b> estritamente necessários para atender as finalidades específicas com fornecedores e prestadores de serviços, incluindo empresas de telemarketing, de processamento de dados, de tecnologia voltada à prevenção a fraudes, correspondentes bancários e empresas ou escritórios especializados em cobrança de dívidas ou para fins de cessão de seus créditos.
            <br/><br/>
            (b). O <b>CREDOR</b> poderá fornecer os dados pessoais do <b>EMITENTE</b> sempre que estiver obrigado, seja em virtude de disposição legal, ato de autoridade competente ou ordem judicial.
        </div>
        <br/><br/>

        <span class="p"></span>31. O(A) <b>EMITENTE</b> autoriza o <b>CREDOR</b> e seus parceiros comerciais, a utilizar seus dados pessoais, com fulcro no endereço eletrônico, endereço residencial,  meios de contato como número de telefone, celular e redes sociais para o envio de material informativo ou promocional, bem como de produtos e/ou serviços oferecidos pelas empresas parceiras autorizadas, a saber: Brasil Card Meios de Pagamentos Ltda., com CNPJ/MF n.º 03.130.170/0001-89; Cobuccio Sociedade de Crédito Direto S.A., com CNPJ nº 34.947.229/0001-85; Bolt Card Credenciadora de Cartão de Crédito Ltda., com CNPJ nº 28.080.769/0001-86 e Guardian Plano Assistencial de Serviço e Suporte Ltda., com o CNPJ 28.796.792/0001-71, inclusive, mas não se limitando, a envio de um Cartão de Crédito com Limite Pré-aprovado em conjunto com abertura de conta digital. Para tanto, o(a) <b>EMITENTE</b> compromete-se a comunicar o <b>CREDOR</b> qualquer alteração de endereço ou requerer o cancelamento do envio das mensagens, produtos e serviços, por meio da Central de Relacionamento do <b>CREDOR</b>, pelo número 0800 573 6600.
        <br/><br/>

        <span class="p"></span>32. Direitos   do Titular.  O <b>EMITENTE</b>,  na  condição  de  titular  dos dados pessoais, tem direito a obter, em relação aos seus dados tratados pelo  <b>CREDOR</b>,  a  qualquer momento e mediante requisição, nos termos da Lei, dentre outros: (i) a confirmação da existência de tratamento; (ii) o acesso aos dados; (iii) a  correção de dados incompletos, inexatos ou desatualizados; (iv) a anonimização, bloqueio ou eliminação de dados pessoais  desnecessários,  excessivos ou tratados em  desconformidade com a Lei; (v) a portabilidade dos dados a outro fornecedor de serviço ou produto, observados os segredos comercial e industrial.
        <br/><br/>

        <span class="p"></span>33. Conservação de Dados. Mesmo após o término desta Cédula de Crédito Bancário, os dados pessoais e outras informações a ele relacionadas poderão ser conservados pelo <b>CREDOR</b> para cumprimento de obrigações legais e regulatórias, bem como para o exercício regular de direitos pelo <b>CREDOR</b>, pelos prazos previstos na legislação vigente.
        <br/><br/>

        <span class="p"></span>34. As partes elegem o foro da cidade de Monte Belo, Estado de Minas Gerais, com exclusão de qualquer outro, por mais privilegiado que seja, para dirimir quaisquer dúvidas ou controvérsias oriundas desta CCB.
        <br/><br/>

        <span style="float: right">Monte Belo / MG, <?= date('d', strtotime($data_geracao_proposta)) . ' de ' . $mes_geracao_proposta . ' de ' . date('Y', strtotime($data_geracao_proposta)) ?></span>
    </div>

    <div style="align-items: center;display: inline;">
        <h2>EMITENTE</h2>
        <h4><span style="color: white;">_______________</span><?= $cliente_assinatura['razao_social'] ?></h4>
    </div>


        <h2>ASSINATURAS</h2>
        <p style="font-size: 9px; line-height: 18px;"><img width="15px" height="15px" src="images/check.png">&nbsp; INCLUSÃO PROPOSTA – PLATAFORMA DIGITAL ÁGIL – VIA <?= ($id_forma_inclusao == 1) ? 'APLICATIVO' : 'TELEFONE'; ?> – PROTOCOLO DE LIGAÇÃO NÚMERO - <?=strtoupper($atd_protocolo)?></p>
        <p style="font-size: 9px; line-height: 18px;"><img width="15px" height="15px" src="images/check.png">&nbsp; APROVAÇÃO DE PROPOSTA COBUCCIO SOCIEDADE DE CRÉDITO DIRETO S.A, NOME FANTASIA ÁGIL, CNPJ: 36.947.229/0001-85, assinou. E-mail: credito@agil.com.br  - IP : 172.31.40.92 Hash: <?=strtoupper('1be95baf66cc80c3f7317e3eeb41a1875eb4db69')?></p>

        @if(!empty($assinaturas))
        <p style="font-size: 9px; line-height: 18px;">
            <img width="15px" height="15px" src="images/check.png">
            &nbsp;
            ACEITE:
            @foreach ($assinaturas as $assinatura)
                {{ $assinatura['nome'] }} ,
            @endforeach

            @if(sizeof($assinaturas)>1)
                ACEITARAM
            @else
                ACEITOU
            @endif
            A PROPOSTA VIA PLATAFORMA ÁGIL
        </p>
        @endif

    <p style="font-size: 9px; line-height: 18px;"><img width="15px" height="15px" src="images/check.png">&nbsp; TESTEMUNHA 1 – DIEGO LUIZ TEIXEIRA – 016.296.656-30, diego@agil.com.br – IP: 172.31.40.92 - HASH: <?=strtoupper('9f86741be6a3b6a70ae4c94e0b1b84c8ab4c1403')?></p>

    <p style="font-size: 9px; line-height: 18px;"><img width="15px" height="15px" src="images/check.png">&nbsp; TESTEMUNHA 2 – CÉLIO ALVES DE OLIVEIRA JÚNIOR – 069.584.136-01, junior@agil.com.br – IP: 172.31.40.92 - HASH: <?=strtoupper('0b8c402e24e3d93208892acb90da9e26675ac567')?></p>

    @foreach ($assinaturas as $assinatura)
    <p style="font-size: 9px; line-height: 18px;"><img width="15px" height="15px" src="images/check.png">&nbsp; ASSINATURA: {{ strtoupper($assinatura['nome'] ?? '-') }} - VIA <?= ($id_forma_inclusao == 1) ? 'APLICATIVO' : 'TELEFONE'; ?> PROTOCOLO NÚMERO – {{ strtoupper($atd_protocolo ?? '-') }}, ASSINOU EM {{ date('d/m/Y H:i:s', strtotime($assinatura['data_aceite_2'] ?? '')) }}, CPF: {{ $assinatura['cpf'] ?? '-' }}, CELULAR: {{ $assinatura['celular'] ?? '-' }}, E-MAIL: {{ $assinatura['email'] ?? '-' }} - IP: {{ $assinatura['ip_cliente'] ?? '-' }} - HASH: {{ $assinatura['hash_assinatura'] ?? '-' }}</p>

    <p style="font-size: 9px; line-height: 18px;"><img width="15px" height="15px" src="images/check.png">&nbsp; EMISSÃO CCB: {{ strtoupper($assinatura['nome'] ?? '-') }}, CONFIRMOU A EMISSÃO DA CCB EM {{ date('d/m/Y H:i:s', strtotime($assinatura['data_aceite_2'] ?? '-')) }}, ATRAVÉS DO IP: {{ $assinatura['ip_cliente'] ?? '-' }} - HASH: {{ $assinatura['hash_assinatura'] ?? '-' }}</p>
    @endforeach

</body>

</html>
